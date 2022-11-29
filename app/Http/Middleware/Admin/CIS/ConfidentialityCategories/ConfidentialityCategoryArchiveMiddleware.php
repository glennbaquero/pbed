<?php

namespace App\Http\Middleware\Admin\CIS\ConfidentialityCategories;

use App\Extenders\BaseMiddleware as Middleware;

class ConfidentialityCategoryArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.confidentiality-categories.archive'];
    }
}
