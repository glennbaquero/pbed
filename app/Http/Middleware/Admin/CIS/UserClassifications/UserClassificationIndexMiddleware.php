<?php

namespace App\Http\Middleware\Admin\CIS\UserClassifications;

use App\Extenders\BaseMiddleware as Middleware;

class UserClassificationIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.user-classifications.index', 'admin.user-classifications.create', 'admin.user-classifications.update', 'admin.user-classifications.archive'];
    }
}
