<?php

namespace App\Http\Middleware\Admin\CMS\Events;

use App\Extenders\BaseMiddleware as Middleware;

class EventIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.events.index', 'admin.events.create', 'admin.events.update', 'admin.events.archive'];
    }
}
