@props([
    'title' => null,
    'showSearch' => true,
    'searchName' => 'search',
    'searchValue' => '',
    'showSort' => false,
    'sortName' => 'sort_by',
    'sortOptions' => [],
    'serverFormId' => null, // when provided the component will submit this form (server mode)
    'clientMode' => false,  // force client-side filtering/sorting
    'cardView' => false,    // enable card view on very small screens (disabled by default)
])

@php
    // Determine mode
    $mode = $clientMode || !$serverFormId ? 'client' : 'server';
@endphp

<div class="google-table-wrapper data-table" data-mode="{{ $mode }}" @if($serverFormId) data-server-form="{{ $serverFormId }}" @endif @if($cardView) data-card-view="true" @endif>
    <div class="google-table-header">
        @if($title)
            <h2 class="google-table-title">{{ $title }}</h2>
        @else
            <div class="google-table-title">{{ $slotName ?? '' }}</div>
        @endif

        <div class="google-table-controls">
            @if($showSearch)
                <div class="google-filter-group google-table-search">
                    <label class="google-filter-label d-none d-sm-inline">{{ __('app.rechercher') }}</label>
                    <input type="search"
                        class="google-filter-input data-table-search"
                        placeholder="{{ __('app.rechercher') }}..."
                        value="{{ $searchValue }}"
                        data-name="{{ $searchName }}"
                    />
                </div>
            @endif

            @if($showSort && count($sortOptions) > 0)
                <div class="google-filter-group google-table-sort">
                    <label class="google-filter-label d-none d-sm-inline">{{ __('app.trier_par') }}</label>
                    <select class="google-filter-input data-table-sort" data-name="{{ $sortName }}">
                        <option value="">{{ __('app.aucun') }}</option>
                        @foreach($sortOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>

    <!-- Table slot: the consumer provides the <table> markup (thead/tbody) -->
    <div class="google-table-container data-table-content">
        {{ $slot }}
    </div>

    {{-- Footer slot for pagination or extra controls --}}
    @isset($footer)
        <div class="google-table-footer">{{ $footer }}</div>
    @endisset
</div>

@push('scripts')
<script>
(function(){
    // Lightweight component script - scoped by data-table class
    function findAncestor(el, selector) {
        while (el && el !== document) {
            if (el.matches && el.matches(selector)) return el;
            el = el.parentNode;
        }
        return null;
    }

    function debounce(fn, wait){
        let t;
        return function(){
            clearTimeout(t);
            const args = arguments;
            t = setTimeout(()=> fn.apply(this, args), wait);
        };
    }

    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.data-table').forEach(function(wrapper){
            const mode = wrapper.getAttribute('data-mode') || 'client';
            const search = wrapper.querySelector('.data-table-search');
            const sort = wrapper.querySelector('.data-table-sort');
            const table = wrapper.querySelector('.data-table-content table');

            // Helper: update/find search/hidden inputs on a server form
            function setAndSubmitServer(formId, name, value) {
                if (!formId) return;
                const form = document.getElementById(formId);
                if (!form) return;
                let input = form.querySelector(`input[name="${name}"]`);
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    form.appendChild(input);
                }
                input.value = value || '';
                // Debounce submission a little
                debounce(()=> form.submit(), 300)();
            }

            // Client-side filter: filters rows by checking textContent of each row
            function clientFilter(term){
                if (!table) return;
                const rows = table.tBodies[0] ? Array.from(table.tBodies[0].rows) : Array.from(table.querySelectorAll('tr'));
                const q = (term || '').toLowerCase().trim();
                let visible = 0;
                rows.forEach(row => {
                    const rowText = (row.textContent || '').toLowerCase();
                    if (q === '' || rowText.includes(q)) {
                        row.style.display = '';
                        visible++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // If a no-results message exists in the same wrapper, show/hide it
                const noResults = wrapper.querySelector('.google-empty-state#noResultsMessage');
                if (noResults) {
                    if (visible === 0) {
                        if (table) table.style.display = 'none';
                        noResults.style.display = 'block';
                    } else {
                        if (table) table.style.display = '';
                        noResults.style.display = 'none';
                    }
                }
            }

            // Client-side sort: simple lexicographic or numeric sort on selected column index
            function clientSort(sortValue){
                if (!table || !sortValue) return;
                // Expecting sortValue as either 'colIndex:asc' or 'colIndex:desc'
                const [colStr, dir] = sortValue.split(':');
                const col = parseInt(colStr, 10);
                if (isNaN(col)) return;
                const tbody = table.tBodies[0];
                if (!tbody) return;
                const rows = Array.from(tbody.rows);
                const isNumeric = rows.every(r => {
                    const text = (r.cells[col] && r.cells[col].textContent) ? r.cells[col].textContent.trim().replace(/[^0-9.,-]/g, '') : '';
                    return text !== '' && !isNaN(Number(text.replace(',', '.')));
                });

                rows.sort((a,b) => {
                    let aText = (a.cells[col] && a.cells[col].textContent) ? a.cells[col].textContent.trim() : '';
                    let bText = (b.cells[col] && b.cells[col].textContent) ? b.cells[col].textContent.trim() : '';

                    if (isNumeric) {
                        aText = Number(aText.replace(',', '.').replace(/[^0-9.-]+/g, '')) || 0;
                        bText = Number(bText.replace(',', '.').replace(/[^0-9.-]+/g, '')) || 0;
                        return (aText - bText) * (dir === 'desc' ? -1 : 1);
                    }

                    return aText.toLowerCase().localeCompare(bText.toLowerCase()) * (dir === 'desc' ? -1 : 1);
                });

                // Re-append rows in order
                rows.forEach(r => tbody.appendChild(r));
            }

            // Event wiring
            if (mode === 'server') {
                // If wrapper has server intent, look for a serverFormId on the inputs (data attribute) or from parent
                // We'll check if component consumer provided search/select and expects server form submission via a global attribute
                // We try to infer the closest form id passed earlier by pages using the component.
                const searchName = search ? search.getAttribute('data-name') : null;
                const sortName = sort ? sort.getAttribute('data-name') : null;
                // Look up forms by common ids sometimes used in pages
                const knownSearchTargets = ['searchForm', 'filtersForm', 'filterForm', 'filtersForm', 'search-form'];
                const chosenFormId = (function(){
                    // prefer explicit target on wrapper
                    const explicit = wrapper.getAttribute('data-server-form');
                    if (explicit) return explicit;
                    // else look for first present known id
                    for (let id of knownSearchTargets) {
                        if (document.getElementById(id)) return id;
                    }
                    return null;
                })();

                // If component attributes include a serverFormId param, we can embed it server-side by the page rendering a 'data-server-form' attribute. But keep fallback logic.
                const configuredForm = wrapper.dataset.serverForm || chosenFormId;

                if (search && configuredForm && searchName) {
                    const debounced = debounce(function(e){
                        setAndSubmitServer(configuredForm, searchName, e.target.value || '');
                    }, 450);

                    search.addEventListener('input', debounced);
                }

                if (sort && configuredForm && sortName) {
                    sort.addEventListener('change', function(e){
                        setAndSubmitServer(configuredForm, sortName, e.target.value || '');
                    });
                }
            }

            if (mode === 'client') {
                if (search) {
                    search.addEventListener('input', debounce(function(e){
                        clientFilter(e.target.value || '');
                    }, 200));
                }
                if (sort) {
                    sort.addEventListener('change', function(e){
                        clientSort(e.target.value || '');
                    });
                }
            }

            // Responsive card view: attach data-label attributes to every TD based on TH text
            // so very-small screens can present a readable stacked card view.
            function ensureCellLabels() {
                if (!table) return;
                const thead = table.querySelector('thead');
                if (!thead) return;
                // Only attach labels when card view is enabled for this component
                if (!(wrapper.dataset.cardView && wrapper.dataset.cardView !== 'false')) return;
                const headers = Array.from(thead.querySelectorAll('th')).map(h => (h.textContent || '').trim());
                const tbodies = table.tBodies.length ? Array.from(table.tBodies) : [];

                tbodies.forEach(tbody => {
                    Array.from(tbody.rows).forEach(row => {
                        Array.from(row.cells).forEach((cell, idx) => {
                            const label = headers[idx] || '';
                            // set data-label for use in CSS content()
                            if (label) cell.setAttribute('data-label', label);
                        });
                    });
                });
            }

            // Run once on init and on resize (debounced) only if card view enabled
            if (wrapper.dataset.cardView && wrapper.dataset.cardView !== 'false') {
                ensureCellLabels();
                const resizeObserver = debounce(function(){ ensureCellLabels(); }, 250);
                window.addEventListener('resize', resizeObserver);
            }
            // resize observer is only attached when cardView enabled above
        });
    });
})();
</script>
@endpush
