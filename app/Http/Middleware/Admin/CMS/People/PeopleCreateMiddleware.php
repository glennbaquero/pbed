<?php

namespace App\Http\Middleware\Admin\CMS\People;

use App\Extenders\BaseMiddleware as Middleware;

class PeopleCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.our-people.create'];
    }
}
