<?php

namespace App\Http\Middleware\Admin\CIS\Reports;

use App\Extenders\BaseMiddleware as Middleware;

class ReportIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.reports.index'];
    }
}
