@props(['activeFilters' => 0])

<div class="google-filter-wrapper">
    <!-- Mobile Filter Button -->
    <div class="google-filter-mobile-toggle">
        <button class="google-filter-btn {{ $activeFilters > 0 ? 'has-filters' : '' }}" type="button" id="filterToggleBtn">
            <i class="fas fa-filter google-filter-icon" aria-hidden="true"></i>
            <span class="google-filter-text">{{ __('app.filtres') }}</span>
            @if($activeFilters > 0)
                <span class="google-filter-badge" id="filterBadge">{{ $activeFilters }}</span>
            @endif
        </button>
    </div>

    <!-- Filters Container -->
    <div class="google-filters" id="filtersContainer">
        <div class="google-filters-header">
            <h3 class="google-filters-title">{{ __('app.filtres') }}</h3>
            <button class="google-filter-close" type="button" id="filterCloseBtn" aria-label="Fermer les filtres">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
        
        <div class="google-filters-content">
            {{ $slot }}
        </div>

        @if(isset($actions))
        <div class="google-filters-actions">
            {{ $actions }}
        </div>
        @endif
    </div>

    <!-- Filter Overlay -->
    <div class="google-filter-overlay" id="filterOverlay"></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterToggleBtn = document.getElementById('filterToggleBtn');
        const filterCloseBtn = document.getElementById('filterCloseBtn');
        const filtersContainer = document.getElementById('filtersContainer');
        const filterOverlay = document.getElementById('filterOverlay');

        function openFilterPanel() {
            if (filtersContainer) filtersContainer.classList.add('active');
            if (filterOverlay) filterOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeFilterPanel() {
            if (filtersContainer) filtersContainer.classList.remove('active');
            if (filterOverlay) filterOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }

        if (filterToggleBtn) {
            filterToggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openFilterPanel();
            });
        }

        if (filterCloseBtn) filterCloseBtn.addEventListener('click', closeFilterPanel);
        if (filterOverlay) filterOverlay.addEventListener('click', closeFilterPanel);
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && filtersContainer && filtersContainer.classList.contains('active')) {
                closeFilterPanel();
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Base Filter Styles (desktop + mobile enhancements) */

    /* Layout of individual filter rows/groups */
    .google-filter-group {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .google-filter-label {
        min-width: 140px;
        font-weight: 600;
        color: #202124;
        margin-bottom: 6px;
        display: block;
    }

    /* Inputs, selects and custom datalist input styling */
    .google-filter-group input[type="search"],
    .google-filter-group input[type="text"],
    .google-filter-group select,
    .google-filter-group .custom-datalist-input,
    .google-filter-group .custom-datalist {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        transition: box-shadow .15s ease, border-color .15s ease;
        -webkit-appearance: none;
        appearance: none;
    }

    .google-filter-group input:focus,
    .google-filter-group select:focus,
    .google-filter-group .custom-datalist-input:focus {
        outline: none;
        border-color: #1967d2;
        box-shadow: 0 6px 18px rgba(25, 103, 210, 0.08);
    }

    /* Compact label+field alignment for wider screens */
    @media (min-width: 769px) {
        .google-filters {
            display: block;
            position: relative;
            border-radius: 8px;
            background: transparent;
            box-shadow: none;
            transform: none;
            visibility: visible;
            padding: 0;
        }

        .google-filters-content {
            padding: 12px 16px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .google-filter-group {
            flex: 1 1 220px;
            min-width: 180px;
            margin-bottom: 0;
        }

        .google-filter-mobile-toggle { display: none; }
        .google-filter-overlay { display: none; }

        .google-filters-actions {
            padding: 12px 16px;
            background: transparent;
            border-top: none;
            justify-content: flex-end;
        }
    }

    /* Mobile Filter Styles (bottom sheet) */
    @media (max-width: 768px) {
        .google-filter-wrapper {
            position: relative;
            margin-bottom: 16px;
        }

        .google-filter-mobile-toggle {
            display: flex !important;
            justify-content: flex-end;
            margin-bottom: 12px;
        }

        .google-filter-btn {
            display: inline-flex;
            align-items: center;
            height: 40px;
            padding: 0 14px;
            background-color: #fff;
            border: 1px solid #dadce0;
            border-radius: 20px;
            color: #3c4043;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s, box-shadow 0.2s, border-color 0.2s;
            box-shadow: none;
        }

        .google-filter-btn:hover { background-color: #f8f9fa; }
        .google-filter-btn:active { background-color: #f1f3f4; }

        .google-filter-btn.has-filters {
            background-color: #e8f0fe;
            color: #1967d2;
            border-color: transparent;
        }

        .google-filter-icon { margin-right: 8px; font-size: 18px; color: #5f6368; }

        .google-filter-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #1967d2;
            color: #fff;
            font-size: 12px;
            height: 20px;
            min-width: 20px;
            padding: 0 6px;
            border-radius: 10px;
            margin-left: 8px;
        }

        .google-filters {
            display: flex !important;
            flex-direction: column;
            position: fixed;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            max-width: 100%;
            height: auto;
            max-height: 85vh;
            background: white;
            z-index: 1050;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -4px 24px rgba(0,0,0,0.12);
            border: none;
            padding: 0;
            transform: translateY(100%);
            visibility: hidden;
            transition: transform 0.35s cubic-bezier(0.4, 0.0, 0.2, 1), visibility 0.35s;
            will-change: transform;
        }

        .google-filters.active { transform: translateY(0); visibility: visible; }

        .google-filters-header {
            display:flex; justify-content:space-between; align-items:center;
            padding: 16px 18px; border-bottom: 1px solid #eaeaea; background:#fff; border-radius:24px 24px 0 0; position:relative;
        }

        .google-filters-header::before { content: ''; position: absolute; top: 8px; left: 50%; transform: translateX(-50%); width: 36px; height: 4px; background-color: #e0e0e0; border-radius: 2px; }

        .google-filters-title { font-size: 1.05rem; font-weight: 600; color: #202124; margin: 0; }

        .google-filter-close { width:36px; height:36px; background:#f3f4f6; border-radius:50%; border:none; display:flex; align-items:center; justify-content:center; cursor:pointer; color:#5f6368; }

        .google-filter-close:hover { background:#e9eefb; color:#1a73e8; }

        .google-filters-content { padding: 16px; overflow-y: auto; flex: 1; -webkit-overflow-scrolling: touch; }

        .google-filters-actions { padding: 12px 16px; padding-bottom: calc(12px + env(safe-area-inset-bottom)); border-top: 1px solid #f0f0f0; background: #fff; display:flex; gap:12px; }

        .google-filters-actions .google-btn { flex:1; justify-content:center; }

        .google-filter-overlay { position: fixed; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.45); z-index:1040; opacity:0; visibility:hidden; transition: opacity .25s ease; pointer-events:none; }
        .google-filter-overlay.active { opacity:1; visibility:visible; pointer-events:auto; }
    }
</style>
@endpush
