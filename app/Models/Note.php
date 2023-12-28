<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $appends = ['attachment_url'];

    protected $hidden = ['attachment'];

    public function getAttachmentUrlAttribute(): array
    {
        $rawFiles = json_decode($this->attachment);

        if (count($rawFiles) > 0) {
            $files = [];
            foreach ($rawFiles as $file) {
                    $files[] = asset($file);
            }
            return $files;
        } else {
            return [];
        }
    }
}
