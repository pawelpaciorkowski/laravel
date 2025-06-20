<?php

namespace App\Http\Services;

use App\Models\InternalEvent;
use Illuminate\Database\Eloquent\Collection;


class InternalEventsServices
{
    public function getInternalEvents()
    {
        return InternalEvent::all();
    }
}
