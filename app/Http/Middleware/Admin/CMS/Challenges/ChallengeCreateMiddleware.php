<?php

namespace App\Http\Middleware\Admin\CMS\Challenges;

use App\Extenders\BaseMiddleware as Middleware;

class ChallengeCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.challenges.create'];
    }
}
