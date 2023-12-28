<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function scopeStatus($query, $value)
    {
        return $query->whereIn('status', $value);
    }

    public function scopePriority($query, $value)
    {
        return $query->whereIn('priority', $value);
    }
}
