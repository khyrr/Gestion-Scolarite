{{--
    Custom Datalist Component
    
    Usage:
    <x-custom-datalist
        name="classe"
        :options="$classes"
        option-value="id_classe"
        option-label="nom_classe"
        placeholder="Sélectionner une classe"
        :selected="request('classe')"
    />
--}}

@props([
    'name' => 'datalist',
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'placeholder' => 'Sélectionner...',
    'selected' => null,
    'required' => false,
    'disabled' => false,
    'searchable' => true,
    'clearable' => true,
])

@php
    $componentId = 'datalist-' . uniqid();
    $selectedOption = collect($options)->firstWhere($optionValue, $selected);
    $selectedLabel = $selectedOption ? data_get($selectedOption, $optionLabel) : '';
@endphp

<div class="custom-datalist" x-data="customDatalist({
    options: {{ json_encode($options) }},
    optionValue: '{{ $optionValue }}',
    optionLabel: '{{ $optionLabel }}',
    selected: '{{ $selected }}',
    searchable: {{ $searchable ? 'true' : 'false' }},
})" x-init="init()" @click.away="close()" {{ $attributes }}>
    
    <!-- Hidden Input (actual form value) -->
    <input type="hidden" name="{{ $name }}" x-model="selectedValue">
    
    <!-- Display Input -->
    <div class="datalist-input-wrapper" @click="toggle()">
        <input 
            type="text"
            class="datalist-input"
            :class="{ 
                'has-value': selectedValue, 
                'disabled': {{ $disabled ? 'true' : 'false' }},
                'is-open': isOpen 
            }"
            x-model="searchQuery"
            @input="handleSearch()"
            @keydown.enter.prevent="selectFirst()"
            @keydown.escape="close()"
            @keydown.arrow-down.prevent="navigateDown()"
            @keydown.arrow-up.prevent="navigateUp()"
            @keydown.tab="close()"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            :readonly="!searchable"
        >
        
        <!-- Icons -->
        <div class="datalist-icons">
            @if($clearable)
                <button 
                    type="button" 
                    class="datalist-clear" 
                    @click.stop="clear()"
                    x-show="selectedValue"
                    x-cloak
                    tabindex="-1"
                    aria-label="Effacer la sélection">
                    <x-icon name="navigation/close" :size="16" :decorative="true" />
                </button>
            @endif
            
            <div class="datalist-arrow" :class="{ 'open': isOpen }">
                <x-icon name="ui/chevron-down" :size="16" :decorative="true" />
            </div>
        </div>
    </div>
    
    <!-- Dropdown List -->
    <div class="datalist-dropdown" x-show="isOpen" x-cloak x-transition:enter="dropdown-enter" x-transition:leave="dropdown-leave">
        <div class="datalist-options" x-ref="optionsList">
            <template x-for="(option, index) in filteredOptions" :key="index">
                <div 
                    class="datalist-option"
                    :class="{ 
                        'selected': selectedValue == getOptionValue(option),
                        'highlighted': highlightedIndex === index 
                    }"
                    @click="select(option)"
                    @mouseenter="highlightedIndex = index"
                    x-text="getOptionLabel(option)">
                </div>
            </template>
            
            <!-- No Results -->
            <div class="datalist-no-results" x-show="filteredOptions.length === 0" x-cloak>
                <x-icon name="empty-states/search-empty" :size="24" :decorative="true" />
                <span>Aucun résultat trouvé</span>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Datalist Styles */
.custom-datalist {
    position: relative;
    width: 100%;
}

.datalist-input-wrapper {
    position: relative;
    cursor: pointer;
}

.datalist-input {
    width: 100%;
    padding: 0.75rem 3rem 0.75rem 1rem;
    font-size: 1rem;
    font-family: inherit;
    color: var(--text-primary, #202124);
    background: var(--bg-surface, #ffffff);
    border: 1px solid var(--border-color, #dadce0);
    border-radius: var(--radius-sm, 8px);
    outline: none;
    transition: all 0.2s ease;
    cursor: pointer;
}

.datalist-input:hover:not(.disabled) {
    border-color: var(--text-secondary, #5f6368);
}

.datalist-input:focus,
.datalist-input.is-open {
    border-color: var(--primary-color, #1a73e8);
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
}

.datalist-input.has-value {
    background: var(--bg-surface, #ffffff);
    border-color: var(--primary-color, #1a73e8);
}

.datalist-input.disabled {
    background: var(--bg-hover, #f8f9fa);
    cursor: not-allowed;
    opacity: 0.6;
}

.datalist-input::placeholder {
    color: var(--text-tertiary, #80868b);
}

.datalist-icons {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    gap: 0.25rem;
    pointer-events: none;
}

.datalist-clear {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding: 0;
    background: transparent;
    border: none;
    border-radius: 50%;
    color: var(--text-secondary, #5f6368);
    cursor: pointer;
    transition: all 0.2s ease;
    pointer-events: all;
}

.datalist-clear:hover {
    background: var(--bg-hover, #f8f9fa);
    color: var(--text-primary, #202124);
}

.datalist-arrow {
    display: flex;
    align-items: center;
    color: var(--text-secondary, #5f6368);
    transition: transform 0.2s ease;
}

.datalist-arrow.open {
    transform: rotate(180deg);
}

.datalist-dropdown {
    position: absolute;
    top: calc(100% + 0.25rem);
    left: 0;
    right: 0;
    z-index: 9999;
    background: var(--bg-surface, #ffffff);
    border: 1px solid var(--border-color, #dadce0);
    border-radius: var(--radius-sm, 8px);
    box-shadow: var(--shadow-md, 0 4px 6px rgba(0, 0, 0, 0.1));
    max-height: 16rem;
    overflow: hidden;
}

.datalist-options {
    max-height: 16rem;
    overflow-y: auto;
    padding: 0.25rem;
}

/* Custom Scrollbar */
.datalist-options::-webkit-scrollbar {
    width: 8px;
}

.datalist-options::-webkit-scrollbar-track {
    background: transparent;
}

.datalist-options::-webkit-scrollbar-thumb {
    background: var(--border-color, #dadce0);
    border-radius: 4px;
}

.datalist-options::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary, #80868b);
}

.datalist-option {
    padding: 0.625rem 0.875rem;
    font-size: 0.875rem;
    color: var(--text-primary, #202124);
    border-radius: var(--radius-sm, 6px);
    cursor: pointer;
    transition: all 0.15s ease;
}

.datalist-option:hover,
.datalist-option.highlighted {
    background: var(--bg-hover, #f8f9fa);
}

.datalist-option.selected {
    background: var(--primary-color, #1a73e8);
    color: white;
    font-weight: 500;
}

.datalist-option.selected:hover {
    background: var(--primary-hover, #1557b0);
}

.datalist-no-results {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    color: var(--text-secondary, #5f6368);
    text-align: center;
}

.datalist-no-results svg {
    margin-bottom: 0.5rem;
    opacity: 0.5;
}

.datalist-no-results span {
    font-size: 0.875rem;
}

/* Transitions */
.dropdown-enter {
    opacity: 0;
    transform: translateY(-0.5rem);
}

.dropdown-leave {
    opacity: 0;
    transform: translateY(-0.5rem);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .datalist-input {
        padding: 0.625rem 2.5rem 0.625rem 0.875rem;
        font-size: 0.875rem;
    }
    
    .datalist-dropdown {
        max-height: 12rem;
    }
    
    .datalist-options {
        max-height: 12rem;
    }
    
    .datalist-option {
        padding: 0.75rem 0.875rem;
        font-size: 0.875rem;
    }
}

/* Alpine.js x-cloak */
[x-cloak] {
    display: none !important;
}
</style>

<script>
function customDatalist(config) {
    return {
        options: config.options || [],
        optionValue: config.optionValue || 'id',
        optionLabel: config.optionLabel || 'name',
        selectedValue: config.selected || '',
        searchQuery: '',
        isOpen: false,
        highlightedIndex: -1,
        filteredOptions: [],
        searchable: config.searchable !== false,
        
        // Helper methods for accessing dynamic properties
        getOptionValue(option) {
            return option[this.optionValue];
        },
        
        getOptionLabel(option) {
            return option[this.optionLabel];
        },
        
        init() {
            this.filteredOptions = this.options;
            
            // Set initial search query to selected label
            if (this.selectedValue) {
                const selectedOption = this.options.find(opt => opt[this.optionValue] == this.selectedValue);
                if (selectedOption) {
                    this.searchQuery = selectedOption[this.optionLabel];
                }
            }
        },
        
        toggle() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.highlightedIndex = -1;
                if (this.searchable) {
                    this.$nextTick(() => {
                        this.$el.querySelector('.datalist-input').focus();
                    });
                }
            }
        },
        
        open() {
            this.isOpen = true;
            this.highlightedIndex = -1;
        },
        
        close() {
            this.isOpen = false;
            // Restore selected value label if search was cleared
            if (!this.searchQuery && this.selectedValue) {
                const selectedOption = this.options.find(opt => opt[this.optionValue] == this.selectedValue);
                if (selectedOption) {
                    this.searchQuery = selectedOption[this.optionLabel];
                }
            }
        },
        
        handleSearch() {
            if (!this.searchable) return;
            
            this.isOpen = true;
            const query = this.searchQuery.toLowerCase();
            
            if (!query) {
                this.filteredOptions = this.options;
            } else {
                this.filteredOptions = this.options.filter(option => {
                    const label = option[this.optionLabel].toLowerCase();
                    return label.includes(query);
                });
            }
            
            this.highlightedIndex = -1;
        },
        
        select(option) {
            this.selectedValue = option[this.optionValue];
            this.searchQuery = option[this.optionLabel];
            this.isOpen = false;
            this.filteredOptions = this.options;
            
            // Dispatch change event after DOM updates
            this.$nextTick(() => {
                this.$el.dispatchEvent(new CustomEvent('change', {
                    detail: { value: this.selectedValue, option: option },
                    bubbles: true
                }));
            });
        },
        
        clear() {
            this.selectedValue = '';
            this.searchQuery = '';
            this.filteredOptions = this.options;
            this.isOpen = false;
            
            // Dispatch change event after DOM updates
            this.$nextTick(() => {
                this.$el.dispatchEvent(new CustomEvent('change', {
                    detail: { value: '', option: null },
                    bubbles: true
                }));
            });
        },
        
        selectFirst() {
            if (this.filteredOptions.length > 0) {
                // If something is highlighted, select it, otherwise select first
                if (this.highlightedIndex >= 0 && this.highlightedIndex < this.filteredOptions.length) {
                    this.select(this.filteredOptions[this.highlightedIndex]);
                } else {
                    this.select(this.filteredOptions[0]);
                }
            }
        },
        
        navigateDown() {
            if (!this.isOpen) {
                this.open();
                return;
            }
            
            if (this.highlightedIndex < this.filteredOptions.length - 1) {
                this.highlightedIndex++;
                this.scrollToHighlighted();
            }
        },
        
        navigateUp() {
            if (this.highlightedIndex > 0) {
                this.highlightedIndex--;
                this.scrollToHighlighted();
            }
        },
        
        scrollToHighlighted() {
            this.$nextTick(() => {
                const optionsList = this.$refs.optionsList;
                const highlightedOption = optionsList.children[this.highlightedIndex];
                
                if (highlightedOption) {
                    highlightedOption.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            });
        }
    };
}
</script>
