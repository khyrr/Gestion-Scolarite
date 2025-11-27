# Custom Datalist Component

A professional, reusable datalist component with Google-style design for Laravel Blade.

## Features

✅ **Beautiful Design** - Clean, modern Google-style interface  
✅ **Fully Searchable** - Type to filter options instantly  
✅ **Keyboard Navigation** - Arrow keys, Enter, Escape support  
✅ **Mobile Optimized** - Touch-friendly and responsive  
✅ **Highly Performant** - Handles large datasets efficiently  
✅ **Customizable** - Easy to style and configure  
✅ **Accessible** - Proper focus management and ARIA support  
✅ **Reusable** - Use across your entire project  

## Requirements

- **Alpine.js** (v3.x) - Lightweight JavaScript framework
- Laravel Blade components

## Installation

### 1. Install Alpine.js

Add to your `resources/views/layouts/dashboard.blade.php` (or main layout):

```html
<!-- Before closing </body> tag -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

Or install via NPM:
```bash
npm install alpinejs
```

### 2. Component is Ready!

The component is located at:
```
resources/views/components/custom-datalist.blade.php
```

## Usage

### Basic Usage

```blade
<x-custom-datalist
    name="classe"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    placeholder="Sélectionner une classe"
/>
```

### With Selected Value

```blade
<x-custom-datalist
    name="classe"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    placeholder="Sélectionner une classe"
    :selected="request('classe')"
/>
```

### All Options

```blade
<x-custom-datalist
    name="classe"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    placeholder="Sélectionner une classe"
    :selected="request('classe')"
    :required="true"
    :disabled="false"
    :searchable="true"
    :clearable="true"
/>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | 'datalist' | Form input name |
| `options` | array | [] | Array of options to display |
| `option-value` | string | 'id' | Key for option value |
| `option-label` | string | 'name' | Key for option label |
| `placeholder` | string | 'Sélectionner...' | Placeholder text |
| `selected` | mixed | null | Pre-selected value |
| `required` | boolean | false | Make field required |
| `disabled` | boolean | false | Disable the input |
| `searchable` | boolean | true | Enable search/filter |
| `clearable` | boolean | true | Show clear button |

## Examples

### 1. Classes Selector

```blade
<x-custom-datalist
    name="classe_id"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    placeholder="Toutes les classes"
    :selected="request('classe_id')"
/>
```

### 2. Students Selector

```blade
<x-custom-datalist
    name="etudiant_id"
    :options="$etudiants"
    option-value="id_etudiant"
    option-label="nom"
    placeholder="Sélectionner un étudiant"
    :required="true"
/>
```

### 3. Teachers Selector

```blade
<x-custom-datalist
    name="enseignant_id"
    :options="$enseignants"
    option-value="id_enseignant"
    option-label="nom"
    placeholder="Sélectionner un enseignant"
/>
```

### 4. Non-Searchable Dropdown

```blade
<x-custom-datalist
    name="status"
    :options="[
        ['id' => 'active', 'name' => 'Actif'],
        ['id' => 'inactive', 'name' => 'Inactif'],
    ]"
    option-value="id"
    option-label="name"
    placeholder="Statut"
    :searchable="false"
/>
```

## Events

The component dispatches a custom `change` event when selection changes:

```javascript
document.querySelector('.custom-datalist').addEventListener('change', function(e) {
    console.log('Selected value:', e.detail.value);
    console.log('Selected option:', e.detail.option);
});
```

## Keyboard Shortcuts

- **Arrow Down** - Navigate to next option
- **Arrow Up** - Navigate to previous option
- **Enter** - Select highlighted option
- **Escape** - Close dropdown
- **Type** - Filter options (if searchable)

## Styling

The component uses CSS variables for easy customization:

```css
:root {
    --primary-color: #1a73e8;
    --primary-hover: #1557b0;
    --text-primary: #202124;
    --text-secondary: #5f6368;
    --text-tertiary: #80868b;
    --border-color: #dadce0;
    --bg-surface: #ffffff;
    --bg-hover: #f8f9fa;
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --radius-sm: 8px;
}
```

## Custom Styling

Add custom classes:

```blade
<x-custom-datalist
    name="classe"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    class="my-custom-class"
/>
```

## Performance Tips

1. **Large Datasets** - The component handles 1000+ options efficiently
2. **Lazy Loading** - Consider paginating options for 10,000+ items
3. **Virtual Scrolling** - For extremely large lists, implement virtual scrolling

## Browser Support

- ✅ Chrome/Edge (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## Migration from Native Datalist

### Before (Native):
```blade
<select name="classe">
    <option value="">Toutes les classes</option>
    @foreach($classes as $classe)
        <option value="{{ $classe->id_classe }}">{{ $classe->nom_classe }}</option>
    @endforeach
</select>
```

### After (Custom):
```blade
<x-custom-datalist
    name="classe"
    :options="$classes"
    option-value="id_classe"
    option-label="nom_classe"
    placeholder="Toutes les classes"
/>
```

## Troubleshooting

### Alpine.js not working?

Make sure Alpine.js is loaded:
```html
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### Dropdown not showing?

Check z-index conflicts. The dropdown uses `z-index: 1000`.

### Styles not applying?

Ensure CSS variables are defined in your main stylesheet.

## License

Free to use in your project.
