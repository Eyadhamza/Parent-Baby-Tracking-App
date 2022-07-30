<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Baby extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birth_date',
    ];

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(ParentUser::class);
    }
}
