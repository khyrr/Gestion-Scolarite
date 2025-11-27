# SVG Icons Directory

This directory contains all SVG icons used throughout the application for better maintainability and consistency.

## Directory Structure

```
svg/
├── actions/         # User actions and CRUD operations
│   ├── plus.svg
│   ├── edit.svg
│   └── delete.svg
├── filters/         # Filter and search related icons
│   ├── filter.svg
│   ├── filter-lines.svg
│   └── reinitialiser.svg
├── empty-states/    # Empty state illustrations
│   ├── search-empty.svg
│   └── clipboard-empty.svg
└── navigation/      # Navigation and UI controls
    ├── close.svg
    └── times.svg
```

## Available Icons

### Actions (`actions/`)
- **plus.svg** - Add/Create new item icon
- **edit.svg** - Edit/Modify icon  
- **delete.svg** - Delete/Remove icon

### Filters (`filters/`)
- **filter.svg** - Generic filter icon
- **filter-lines.svg** - Filter icon with lines (used for mobile filter toggle)
- **reinitialiser.svg** - Reset/Refresh filters icon

### Empty States (`empty-states/`)
- **search-empty.svg** - No search results found
- **clipboard-empty.svg** - No data/empty list state

### Navigation (`navigation/`)
- **close.svg** - Close/Dismiss icon
- **times.svg** - Cancel/Remove icon

## Usage

### In Blade Templates

```blade
<!-- Direct usage with organized paths -->
<img src="{{ asset('svg/actions/plus.svg') }}" width="20" height="20" alt="Ajouter" />
<img src="{{ asset('svg/filters/reinitialiser.svg') }}" width="20" height="20" alt="Réinitialiser" />

<!-- Using the icon component (recommended) -->
<x-icon name="plus" category="actions" :size="20" alt="Ajouter" />

<!-- Or with slash notation -->
<x-icon name="actions/plus" :size="20" alt="Ajouter" />

<!-- With CSS class for styling -->
<x-icon name="filters/filter-lines" :size="20" class="icon-class" alt="Filtres" />
```

### Benefits of External SVG Files

1. **Maintainability** - Update icon in one place, changes reflect everywhere
2. **Clean Code** - Reduces template clutter and improves readability
3. **Reusability** - Same icon can be used across multiple pages
4. **Consistency** - Ensures visual consistency across the application
5. **Performance** - Browser can cache SVG files
6. **Version Control** - Easier to track changes to individual icons

## Adding New Icons

1. Determine the appropriate category (actions, filters, empty-states, navigation)
2. Create a new `.svg` file in the correct subdirectory
3. Use `viewBox="0 0 24 24"` for consistency
4. Use `currentColor` for stroke/fill to allow CSS color control
5. Use descriptive, kebab-case filenames (e.g., `user-profile.svg`)
6. Add entry to this README under the appropriate category

**Example:**
```bash
# Create new action icon (follows naming convention)
nano public/svg/actions/save.svg

# Create new navigation icon
nano public/svg/navigation/arrow-left.svg

# Create new status icon
nano public/svg/status/check-circle.svg
```

### Naming Checklist
Before creating a new icon, verify:
- [ ] Uses kebab-case format
- [ ] Name is descriptive and clear
- [ ] Follows category conventions
- [ ] No abbreviations (unless standard)
- [ ] Consistent with existing icons
- [ ] No redundant words (icon, svg, etc.)
- [ ] Action verbs are standard (add, edit, delete)

## Icon Variants

The icon system supports two visual styles:

### Available Variants

| Variant | Style | Usage |
|---------|-------|-------|
| `outline` | Stroke-based, hollow icons | Default, lighter appearance, modern UI |
| `solid` | Fill-based, filled icons | Emphasis, active states, bold design |

### Variant Structure

```
public/svg/
├── outline/           # Default stroke-based icons
│   ├── actions/
│   ├── filters/
│   ├── empty-states/
│   └── navigation/
├── solid/             # Filled icons
│   ├── actions/
│   ├── filters/
│   ├── empty-states/
│   └── navigation/
├── actions/           # Legacy (maps to outline)
├── filters/
├── empty-states/
└── navigation/
```

### Usage Examples

```blade
<!-- Outline variant (default) -->
<x-icon name="actions/plus" />
<x-icon name="actions/plus" variant="outline" />

<!-- Solid variant -->
<x-icon name="actions/plus" variant="solid" />

<!-- Different contexts -->
<button class="btn-primary">
    <x-icon name="actions/edit" variant="solid" size="sm" />
    Edit
</button>

<a href="#" class="nav-link">
    <x-icon name="navigation/close" variant="outline" />
    Close
</a>
```

### When to Use Each Variant

**Outline Icons:**
- Default choice for most UI elements
- Navigation menus and secondary actions
- Light, airy interfaces
- When you want less visual weight
- Better for small sizes (14-18px)

**Solid Icons:**
- Primary action buttons
- Active/selected states
- Icons that need emphasis
- Better for larger sizes (24px+)
- When you want more visual impact

### Design Consistency

Both variants:
- Use `currentColor` for fill/stroke
- Share the same `viewBox="0 0 24 24"`
- Are optimized with SVGO
- Support all color theming options
- Work with all size classes

### Practical Examples

```blade
<!-- Primary action button with solid icon -->
<button class="google-btn google-btn-primary">
    <x-icon name="actions/plus" variant="solid" :size="20" :decorative="true" />
    <span>Ajouter</span>
</button>

<!-- Secondary action with outline icon -->
<button class="google-action-btn">
    <x-icon name="actions/edit" variant="outline" :size="18" label="Modifier" />
</button>

<!-- Active navigation item with solid icon -->
<a href="/dashboard" class="nav-item active">
    <x-icon name="navigation/close" variant="solid" />
    <span>Dashboard</span>
</a>

<!-- Inactive navigation item with outline icon -->
<a href="/settings" class="nav-item">
    <x-icon name="navigation/close" variant="outline" />
    <span>Settings</span>
</a>

<!-- Empty state with solid icon for emphasis -->
<div class="empty-state">
    <x-icon name="empty-states/search-empty" variant="solid" size="3xl" :decorative="true" />
    <h3>No results found</h3>
</div>
```

### Combining with Color Theming

```blade
<!-- Outline icon with hover transition to solid -->
<style>
.icon-btn img {
    transition: all 0.2s ease;
}
.icon-btn:hover img {
    /* Could dynamically swap variant on hover via JS if needed */
}
</style>

<!-- Solid delete icon with red color -->
<button class="google-action-delete">
    <x-icon name="actions/delete" variant="solid" :size="18" />
</button>
```

---

## Icon Sizing

The icon component supports standardized size values for consistency:

### Size Options

| Size | Pixels | Usage |
|------|--------|-------|
| `xs` | 14px | Very small icons, inline text icons |
| `sm` | 18px | Small buttons, compact UI |
| `md` | 20px | Default size, standard buttons |
| `lg` | 24px | Large buttons, headers |
| `xl` | 32px | Extra large UI elements |
| `2xl` | 40px | Hero sections, large cards |
| `3xl` | 48px | Jumbo displays |

### Usage Examples

```blade
<!-- Using standardized sizes -->
<x-icon name="actions/plus" size="sm" />
<x-icon name="filters/filter-lines" size="md" />
<x-icon name="actions/edit" size="lg" />
<x-icon name="empty-states/search-empty" size="3xl" />

<!-- Using custom pixel values -->
<x-icon name="actions/delete" :size="16" />
<x-icon name="navigation/close" :size="28" />
```

### CSS Classes

Each standardized size automatically adds a corresponding CSS class:

```css
.icon-xs { width: 14px; height: 14px; }
.icon-sm { width: 18px; height: 18px; }
.icon-md { width: 20px; height: 20px; }
.icon-lg { width: 24px; height: 24px; }
.icon-xl { width: 32px; height: 32px; }
.icon-2xl { width: 40px; height: 40px; }
.icon-3xl { width: 48px; height: 48px; }
```

---

## Accessibility

The icon component supports comprehensive accessibility features:

### Decorative Icons

For icons that are purely decorative (accompanied by visible text), use the `decorative` prop:

```blade
<!-- Icon with visible text label -->
<button>
    <x-icon name="actions/plus" :decorative="true" />
    <span>Ajouter</span>
</button>
```

This will:
- Set `alt=""` to hide the icon from screen readers
- Add `aria-hidden="true"` to explicitly mark as decorative
- Let the visible text provide the accessible name

### Meaningful Icons

For standalone icons without visible text, provide a descriptive label:

```blade
<!-- Icon button without text -->
<button aria-label="Modifier l'évaluation">
    <x-icon name="actions/edit" label="Modifier" />
</button>

<!-- Icon link with specific context -->
<a href="/delete" aria-label="Supprimer {{ $item->name }}">
    <x-icon name="actions/delete" label="Supprimer" />
</a>
```

This will:
- Set `alt` attribute with the label
- Add `role="img"` for proper semantics
- Make the icon meaningful to screen readers

### Tooltips

Add tooltips for additional context:

```blade
<x-icon name="actions/edit" 
        label="Modifier" 
        title="Modifier cette évaluation" />
```

### Best Practices

1. **Always provide context for action buttons:**
   ```blade
   <button aria-label="Supprimer la note de {{ $student->name }}">
       <x-icon name="actions/delete" label="Supprimer" />
   </button>
   ```

2. **Use decorative for icons with text:**
   ```blade
   <a href="/create">
       <x-icon name="actions/plus" :decorative="true" />
       <span>Créer</span>  {{-- Screen readers use this --}}
   </a>
   ```

3. **Test with screen readers:**
   - NVDA (Windows)
   - JAWS (Windows)
   - VoiceOver (macOS/iOS)
   - TalkBack (Android)

4. **Ensure keyboard navigation:**
   - All interactive icons should be in focusable elements
   - Visible focus indicators
   - Logical tab order

---

## Icon Naming Convention

### Standard Format
Use **kebab-case** with descriptive names following this pattern:
```
{object}-{action/state}-{modifier}.svg
```

### Naming Rules
1. **Use kebab-case** - All lowercase with hyphens (e.g., `user-add.svg`)
2. **Be descriptive but concise** - Clear purpose without being verbose
3. **Group with prefixes** - Related icons share common prefix
4. **Avoid abbreviations** - Unless standard (btn, nav, etc.)
5. **Action verbs** - Use consistent verbs (add, edit, delete, create, etc.)

### Examples by Category

**Actions:**
```
✅ plus.svg (generic add)
✅ edit.svg (generic modify)
✅ delete.svg (generic remove)
✅ save.svg
✅ cancel.svg
✅ user-add.svg (specific: add user)
✅ file-upload.svg (specific: upload file)
✅ file-download.svg (specific: download file)
```

**Navigation:**
```
✅ close.svg
✅ times.svg (alternative close/cancel)
✅ arrow-left.svg
✅ arrow-right.svg
✅ arrow-up.svg
✅ arrow-down.svg
✅ chevron-left.svg
✅ chevron-right.svg
✅ menu.svg
✅ back.svg
```

**Filters:**
```
✅ filter.svg (generic filter)
✅ filter-lines.svg (filter with lines)
✅ reinitialiser.svg (reset/refresh)
✅ sort.svg
✅ sort-asc.svg
✅ sort-desc.svg
✅ search.svg
```

**Empty States:**
```
✅ search-empty.svg (no search results)
✅ clipboard-empty.svg (no data)
✅ inbox-empty.svg (no items)
✅ folder-empty.svg (no files)
```

**Status/State:**
```
✅ status-success.svg
✅ status-error.svg
✅ status-warning.svg
✅ status-info.svg
✅ check.svg
✅ check-circle.svg
✅ alert-triangle.svg
```

### Bad Examples (Avoid)
```
❌ plusIcon.svg (camelCase)
❌ PLUS.svg (uppercase)
❌ add_user.svg (snake_case)
❌ usr-add.svg (unclear abbreviation)
❌ create-new-user-icon.svg (too verbose)
❌ icon-plus.svg (redundant prefix)
❌ plus-icon-small.svg (size in name)
```

## Icon Color Theming

Icons support dynamic color theming through CSS filters. The system automatically applies appropriate colors based on context.

### Color Classes

**Primary Buttons (Blue background):**
- Icons are automatically white using `filter: brightness(0) invert(1)`

**Secondary Buttons (White background):**
- Icons use gray color matching the text

**Action Buttons:**
- Default: Gray color
- Hover: Blue color (interactive feedback)
- Delete action hover: Red color (danger indication)

### Custom Icon Colors

To apply custom colors to icons, use CSS filters:

```css
/* White icon */
.icon-white {
    filter: brightness(0) invert(1);
}

/* Blue icon (#1a73e8) */
.icon-blue {
    filter: brightness(0) saturate(100%) invert(27%) sepia(98%) 
            saturate(2366%) hue-rotate(203deg) brightness(98%) contrast(99%);
}

/* Red icon (#c5221f) */
.icon-red {
    filter: brightness(0) saturate(100%) invert(23%) sepia(93%) 
            saturate(3347%) hue-rotate(347deg) brightness(91%) contrast(95%);
}

/* Gray icon (#5f6368) */
.icon-gray {
    filter: brightness(0) saturate(100%) invert(42%) sepia(8%) 
            saturate(495%) hue-rotate(180deg) brightness(94%) contrast(88%);
}
```

### Using Color Theming

```blade
<!-- Icon inherits color from parent context -->
<x-icon name="actions/plus" :size="20" alt="Ajouter" />

<!-- Specific icon with white color -->
<x-icon name="actions/print" :size="20" class="icon-white" alt="Imprimer" />

<!-- Specific icon with red color (for delete actions) -->
<x-icon name="actions/delete" :size="18" class="icon-red" alt="Supprimer" />

<!-- Specific icon with blue color (for primary actions) -->
<x-icon name="actions/edit" :size="18" class="icon-blue" alt="Modifier" />

<!-- Multiple icons in buttons with different colors -->
<button class="btn-primary">
    <x-icon name="actions/plus" class="icon-white" :decorative="true" />
    <span>Ajouter</span>
</button>

<button class="btn-danger">
    <x-icon name="actions/delete" class="icon-white" :decorative="true" />
    <span>Supprimer</span>
</button>
```

### Automatic Color Inheritance

For buttons that need white icons automatically, add CSS rules:

```css
/* All icons in primary buttons are white */
.action-btn.primary .icon,
.btn-primary .icon {
    filter: brightness(0) invert(1);
}

/* Or target specific icon within a button */
.print-button .icon {
    filter: brightness(0) invert(1);
}
```

## Icon Guidelines

- **Size**: Design icons on a 24×24 pixel grid
- **Stroke Width**: Use 2px for consistency
- **Color**: Use `currentColor` in SVG to enable CSS filter theming
- **Format**: Keep SVGs clean and optimized (remove unnecessary attributes)
- **Accessibility**: Always provide meaningful `alt` text when using with `<img>` tag
