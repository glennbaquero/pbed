<?php

namespace App\Http\Middleware\Admin\CMS\Members;

use App\Extenders\BaseMiddleware as Middleware;

class MemberIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.members.index', 'admin.members.create', 'admin.members.update', 'admin.members.archive'];
    }
}
