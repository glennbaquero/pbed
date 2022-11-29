<?php

namespace App\Http\Middleware\Admin\CMS\Events;

use App\Extenders\BaseMiddleware as Middleware;

class EventUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.events.update'];
    }
}
