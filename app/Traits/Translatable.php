<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Get translated attribute value
     */
    public function getTranslation($attribute, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translationField = $attribute . '_translations';
        
        if ($this->hasAttribute($translationField) && $this->{$translationField}) {
            $translations = is_string($this->{$translationField}) 
                ? json_decode($this->{$translationField}, true) 
                : $this->{$translationField};
                
            if (is_array($translations) && isset($translations[$locale])) {
                return $translations[$locale];
            }
        }
        
        // Fallback to the base attribute
        return $this->{$attribute};
    }
    
    /**
     * Set translation for an attribute
     */
    public function setTranslation($attribute, $locale, $value)
    {
        $translationField = $attribute . '_translations';
        
        if ($this->hasAttribute($translationField)) {
            $translations = $this->{$translationField} ?: [];
            $translations[$locale] = $value;
            $this->{$translationField} = $translations;
        }
        
        return $this;
    }
    
    /**
     * Check if model has attribute
     */
    public function hasAttribute($attribute)
    {
        return in_array($attribute, $this->fillable) || 
               array_key_exists($attribute, $this->attributes);
    }
}
