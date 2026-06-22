<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order', 'asc');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'course_favorites');
    }
}
