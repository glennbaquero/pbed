<?php

namespace App\Http\Middleware\Admin\CMS\Procurements;

use App\Extenders\BaseMiddleware as Middleware;

class ProcurementIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.procurements.index', 'admin.procurements.create', 'admin.procurements.update', 'admin.procurements.archive'];
    }
}
