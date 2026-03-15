<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'encrypted_key',
        'file_size',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shares()
    {
        return $this->hasMany(\App\Models\FileShare::class, 'file_id', 'id');
    }
}
