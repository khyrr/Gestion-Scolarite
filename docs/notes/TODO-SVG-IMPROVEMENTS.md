# TODO: SVG Icons Improvements

## Future Enhancements

### 1. Implement Icon Component Usage ✅ COMPLETED
Replace direct `<img>` tags with the icon component for cleaner code:

**Before:**
```blade
<img src="{{ asset('svg/actions/plus.svg') }}" width="20" height="20" alt="Ajouter" />
```

**After:**
```blade
<x-icon name="actions/plus" :size="20" alt="Ajouter" />
```

**Files updated:**
- [x] `resources/views/academic/evaluations/index.blade.php`
- [x] `resources/views/academic/notes/index.blade.php`
- [ ] Other pages using SVG icons (to be done as needed)

---

### 2. Organize Icons into Subdirectories ✅ COMPLETED
Create a better folder structure for scalability:

```
public/svg/
├── actions/        # edit.svg, delete.svg, plus.svg
├── navigation/     # close.svg, times.svg
├── filters/        # filter.svg, filter-lines.svg, reinitialiser.svg
└── empty-states/   # search-empty.svg, clipboard-empty.svg
```

**Tasks:**
- [x] Create subdirectories
- [x] Move existing SVGs to appropriate folders
- [x] Update asset paths in Blade files
- [x] Update icon component to support subdirectories
- [x] Update README with new structure

---

### 3. Optimize SVG Files ✅ COMPLETED
Use SVGO to reduce file size and clean up unnecessary attributes:

**Installation:**
```bash
npm install -g svgo
# or
yarn global add svgo
```

**Usage:**
```bash
svgo public/svg/*.svg
# or for specific file
svgo public/svg/plus.svg
```

**Batch optimization:**
```bash
find public/svg -name "*.svg" -exec svgo {} \;
```

---

### 4. Implement SVG Sprite Sheet
For better performance when using many icons:

**Benefits:**
- Single HTTP request for all icons
- Reduced bandwidth
- Better caching

**Implementation:**
```blade
<!-- sprite.svg -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="plus" viewBox="0 0 24 24">
        <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor"/>
        <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor"/>
    </symbol>
    <!-- more symbols... -->
</svg>

<!-- Usage -->
<svg class="icon" width="20" height="20">
    <use href="{{ asset('svg/sprite.svg#plus') }}"></use>
</svg>
```

**Tasks:**
- [ ] Create sprite sheet generator script
- [ ] Generate sprite.svg from individual files
- [ ] Update icon component to support sprite mode
- [ ] Add build step to regenerate sprite on changes

---

### 5. Add Icon Variants ✅ COMPLETED
Support different icon styles:

```
public/svg/
├── outline/    # Current stroke-based icons
├── solid/      # Filled versions
└── duotone/    # Two-tone variants
```

**Icon component update:**
```blade
<x-icon name="plus" variant="solid" :size="20" />
```

---

### 6. Implement Color Theming ✅ COMPLETED
Enhance CSS for dynamic icon colors using CSS filters:

**Implemented:**
```css
/* Primary button - White icons */
.google-btn-primary img {
    filter: brightness(0) invert(1);
}

/* Action buttons - Gray with blue hover */
.google-action-btn img {
    filter: brightness(0) saturate(100%) invert(42%)...;
}

.google-action-btn:hover img {
    filter: brightness(0) saturate(100%) invert(27%) sepia(98%)...;
}

/* Delete button - Red on hover */
.google-action-delete:hover img {
    filter: brightness(0) saturate(100%) invert(23%) sepia(93%)...;
}
```

**Colors Supported:**
- White (primary buttons)
- Blue (#1a73e8) - hover states
- Red (#c5221f) - delete actions
- Gray (#5f6368) - default state

---

### 7. Icon Size Standardization ✅ COMPLETED
Create predefined size classes:

```css
.icon-xs { width: 14px; height: 14px; }
.icon-sm { width: 18px; height: 18px; }
.icon-md { width: 20px; height: 20px; } /* default */
.icon-lg { width: 24px; height: 24px; }
.icon-xl { width: 32px; height: 32px; }
```

**Usage:**
```blade
<x-icon name="plus" size="lg" />
```

---

### 8. Accessibility Improvements ✅ COMPLETED
Enhance icon accessibility:

```blade
<!-- Icon component update -->
@props([
    'name' => 'plus',
    'size' => 20,
    'decorative' => false,  // If true, hide from screen readers
    'label' => ''           // Accessible label
])

@if($decorative)
    <img src="{{ asset("svg/{$name}.svg") }}" 
         width="{{ $size }}" 
         height="{{ $size }}" 
         alt=""
         aria-hidden="true"
         {{ $attributes }} />
@else
    <img src="{{ asset("svg/{$name}.svg") }}" 
         width="{{ $size }}" 
         height="{{ $size }}" 
         alt="{{ $label ?: $name }}"
         role="img"
         {{ $attributes }} />
@endif
```

---

### 9. Icon Animation Support
Add CSS animations for interactive icons:

```css
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.icon-spin {
    animation: spin 1s linear infinite;
}

.icon-pulse {
    animation: pulse 2s ease-in-out infinite;
}
```

**Usage:**
```blade
<x-icon name="reinitialiser" class="icon-spin" />
```

---

### 10. Icon Naming Convention Guide
Establish consistent naming rules:

**Pattern:** `{category}-{action/state}-{modifier}.svg`

**Examples:**
- `user-add.svg`, `user-edit.svg`, `user-delete.svg`
- `file-upload.svg`, `file-download.svg`
- `arrow-left.svg`, `arrow-right.svg`, `arrow-up.svg`
- `status-success.svg`, `status-error.svg`, `status-warning.svg`

**Rules:**
- Use kebab-case
- Be descriptive but concise
- Group related icons with prefixes
- Avoid abbreviations unless standard (e.g., btn, nav)

---

### 11. Development Tools
Create helper scripts:

**Generate icon index:**
```php
// artisan command: php artisan icons:list
public function handle()
{
    $icons = File::files(public_path('svg'));
    foreach ($icons as $icon) {
        $this->info($icon->getFilenameWithoutExtension());
    }
}
```

**Icon preview page:**
```blade
<!-- Route: /dev/icons -->
<div class="icon-grid">
    @foreach($icons as $icon)
        <div class="icon-card">
            <x-icon :name="$icon" :size="32" />
            <span>{{ $icon }}</span>
        </div>
    @endforeach
</div>
```

---

### 12. Build Process Integration
Add to build pipeline:

**package.json:**
```json
{
  "scripts": {
    "icons:optimize": "svgo public/svg/**/*.svg",
    "icons:sprite": "node scripts/generate-sprite.js",
    "build": "npm run icons:optimize && npm run icons:sprite && vite build"
  }
}
```

---

## Priority Tasks

**High Priority:**
- [x] Implement icon component usage across all pages ✅
- [x] Organize icons into subdirectories ✅
- [x] Optimize existing SVG files with SVGO ✅
- [x] Add icon size standardization ✅

**Medium Priority:**
- [x] Implement color theming in CSS ✅
- [x] Add accessibility improvements ✅

**Low Priority:**
- [ ] Create SVG sprite sheet
- [x] Add icon variants (solid, outline) ✅
- [ ] Build icon preview page

---

## Notes

- Keep backward compatibility when implementing changes
- Test icon rendering across different browsers
- Document any new conventions in the main README
- Consider performance impact of large sprite sheets
- Update documentation as features are implemented
