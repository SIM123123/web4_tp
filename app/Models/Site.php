<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Site extends Model
{
    use HasFactory;
    use Searchable;


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function toSearchableArray()
    {
        return ['adresse_site' => $this->adresse_site];
    }
}
