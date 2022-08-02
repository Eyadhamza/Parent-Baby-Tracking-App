<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class ParentUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'partner_id'
    ];

    public function partner(): HasOne
    {
        return $this->hasOne(ParentUser::class,'partner_id');
    }

    public function babies(): BelongsToMany
    {
        return $this->belongsToMany(Baby::class);
    }

    /**
     * @throws \Throwable
     */
    public function invite(string $parentId): void
    {
        throw_if($this->id == $parentId, \Exception::class, 'You can not invite yourself');

        throw_if($this->partner_id, \Exception::class, 'You already have a partner');

        DB::transaction(function () use ($parentId) {
            $parent = ParentUser::findOrFail($parentId);

            $this->update(['partner_id' => $parent->id]);
            $this->partner()->save($parent);

        });
    }
}
