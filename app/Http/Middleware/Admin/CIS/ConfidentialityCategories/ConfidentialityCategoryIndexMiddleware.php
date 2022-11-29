<?php

namespace App\Http\Middleware\Admin\CIS\ConfidentialityCategories;

use App\Extenders\BaseMiddleware as Middleware;

class ConfidentialityCategoryIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.confidentiality-categories.index', 'admin.confidentiality-categories.create', 'admin.confidentiality-categories.update', 'admin.confidentiality-categories.archive'];
    }
}
