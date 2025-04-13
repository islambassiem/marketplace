<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'type',
        'subject',
        'body',
    ];

    const TYPES = [
        '1' => 'Complaint',
        '2' => 'Suggestion',
        '3' => 'Question',
        '4' => 'Other',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
