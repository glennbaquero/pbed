<?php

namespace App\Http\Middleware\Admin\CIS\UserClassifications;

use App\Extenders\BaseMiddleware as Middleware;

class UserClassificationArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.user-classifications.archive'];
    }
}
