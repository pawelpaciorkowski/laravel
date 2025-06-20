<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternalEvent extends Model
{
    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "InternalEvents";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Title',
        'ShortDescription',
        'ContentHTML',
        'EventDateTime',
        'Link',
        'IsPublic',
        'IsCancelled',
        'PublishDateTime',
        'CreationDateTime',
        'EditDateTime',
        'IsActive',
    ];
}
