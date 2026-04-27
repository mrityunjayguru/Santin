<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $table = 'art';

    protected $fillable = [
        'art_id',
        'artist',
        'title',
        'type',
        'size',
        'frame',
        'date',
        'location',
        'ownership',
        'inventory_status',
        'bundle',
        'pkg_quantity',
        'notes',
    ];

    public function images()
    {
        return $this->hasMany(ArtImages::class, 'art_id', 'id');
    }
}
