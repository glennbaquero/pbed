<?php

namespace App\Http\Middleware\Admin\CMS\Procurements;

use App\Extenders\BaseMiddleware as Middleware;

class ProcurementCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.procurements.create'];
    }
}
