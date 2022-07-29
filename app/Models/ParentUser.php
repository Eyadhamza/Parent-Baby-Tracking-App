<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ParentUser extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function partner(): HasOne
    {
        return $this->hasOne(ParentUser::class);
    }

    public function babies(): BelongsToMany
    {
        return $this->belongsToMany(Baby::class);
    }

    public function invite(string $parentId): void
    {
        $this->partner()->associate(ParentUser::find($parentId));
        $this->save();
    }
}
