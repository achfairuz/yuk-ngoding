<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'contact',
        'project_type',
        'message',
    ];

    protected static function booted(): void
    {
        static::creating(function (contact $contact): void {
            if (! $contact->getKey()) {
                $contact->id = 'QST-'.Str::uuid()->toString();
            }
        });
    }
}
