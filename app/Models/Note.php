<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Note extends Model
{
    use HasFactory, LogsActivity;
    
    protected $primaryKey = 'id_note';
    protected $fillable = ['note','type','id_matiere','id_etudiant','id_evaluation','id_classe','commentaire'];
    
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id_note';
    }
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
    
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'id_evaluation');
    }
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id_matiere');
    }

    /**
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['note', 'id_etudiant', 'id_evaluation', 'commentaire'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Grade {$eventName}");
    }
    
    use HasFactory;
}
