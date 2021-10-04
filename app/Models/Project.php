<?php

namespace App\Models;

use App\Rules\Slug;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function scopeSearch(Builder $Query, $values)
    {
        if (is_null($values)) {
            return;
        }
        foreach (Str::of($values)->explode(' ') as $value) {
            $Query->where('name', 'LIKE', "%{$value}%");
        }
    }
}
