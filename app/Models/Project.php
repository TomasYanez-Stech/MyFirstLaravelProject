<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = "project";
    // protected $fillable = ["title", "slug", "description"];
    protected $guarded = ["id", "created_at", "updated_at"];

    // @override
    public function getRouteKeyName() {
        return "slug";
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
