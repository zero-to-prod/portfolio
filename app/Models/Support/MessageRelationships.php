<?php

namespace App\Models\Support;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MessageRelationships
{
    public const contact = 'contact';
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
