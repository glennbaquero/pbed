<?php

namespace App\Http\Middleware\Admin\CIS\Reports;

use App\Extenders\BaseMiddleware as Middleware;

class ReportExportMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.reports.export'];
    }
}
