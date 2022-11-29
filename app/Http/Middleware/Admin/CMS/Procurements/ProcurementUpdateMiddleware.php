<?php

namespace App\Http\Middleware\Admin\CMS\Procurements;

use App\Extenders\BaseMiddleware as Middleware;

class ProcurementUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.procurements.update'];
    }
}
