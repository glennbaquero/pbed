<?php

namespace App\Http\Middleware\Admin\CMS\Challenges;

use App\Extenders\BaseMiddleware as Middleware;

class ChallengeIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.challenges.index', 'admin.challenges.create', 'admin.challenges.update', 'admin.challenges.archive'];
    }
}
