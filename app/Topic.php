<?php

namespace App;

use App\Lesson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Topic extends Model
{
    use HasTranslations;

    protected $translatable = ['name'];

    protected $fillable = [
        'name', 
        'number'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function toArray()
    {
        $attributes = parent::toArray();
        
        foreach ($this->getTranslatableAttributes() as $name) {
            $attributes[$name] = $this->getTranslation($name, app()->getLocale());
        }
        
        return $attributes;
    }
}
