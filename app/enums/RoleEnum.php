<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ROOT = 'root';
    case ADMIN = 'admin';
    case USER = 'user';
}
