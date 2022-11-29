<?php

namespace App\Http\Middleware\Admin\CMS\Members;

use App\Extenders\BaseMiddleware as Middleware;

class MemberUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.members.update'];
    }
}
