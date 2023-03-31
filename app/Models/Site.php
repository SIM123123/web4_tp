<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Site extends Model
{
    use HasFactory;
    use Searchable;

<<<<<<< HEAD
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function toSearchableArray()
    {
        return ['adresse_site' => $this->adresse_site];
    }
=======
    public function toSearchableArray(): array
    {
        return [
            'adresse_site' => $this->adresse_site,
        ];
    }

>>>>>>> 4d5bb63 (lemerge)
}
