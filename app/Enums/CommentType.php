<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Enums;

enum CommentType: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case ANONYMOUS = 'anonymous';
}