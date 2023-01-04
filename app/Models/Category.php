<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'parent_id', 'image_path',
    ];

    // protected $guarded = ['id'];

    //Accessors Functions
    // $category->image_url
    public function getImageUrlAttribute()
    {
        if($this->image_path){
            return asset('storage/' . $this->image_path);
        }
        return asset('images/default-thumbnail.jpg');
    }

    public function getNameAttribute($value)
    {
        return Str::title($value); //ucwords()
    }

    // Mutators
    // $category -> name = "Watches";
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
    
    
}