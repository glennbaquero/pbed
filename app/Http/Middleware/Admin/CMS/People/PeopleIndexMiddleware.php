<?php

namespace App\Http\Middleware\Admin\CMS\People;

use App\Extenders\BaseMiddleware as Middleware;

class PeopleIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.our-people.index', 'admin.our-people.create', 'admin.our-people.update', 'admin.our-people.archive'];
    }
}
