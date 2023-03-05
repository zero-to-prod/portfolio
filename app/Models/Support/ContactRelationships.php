<?php

namespace App\Models\Support;

use App\Models\Message;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ContactRelationships
{
    public const messages = 'messages';

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
