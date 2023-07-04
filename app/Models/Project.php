<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = "project";
    // protected $fillable = ["title", "slug", "description"];
    protected $guarded = ["id", "created_at", "updated_at"];

    // @override
    public function getRouteKeyName() {
        return "slug";
    }
}
