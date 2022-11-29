<?php

namespace App\Http\Middleware\Admin\CMS\GrowthSectors;

use App\Extenders\BaseMiddleware as Middleware;

class GrowthSectorArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.growth-sectors.archive'];
    }
}
