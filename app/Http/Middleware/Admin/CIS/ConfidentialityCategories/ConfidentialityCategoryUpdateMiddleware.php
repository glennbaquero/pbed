<?php

namespace App\Http\Middleware\Admin\CIS\ConfidentialityCategories;

use App\Extenders\BaseMiddleware as Middleware;

class ConfidentialityCategoryUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.confidentiality-categories.update'];
    }
}
