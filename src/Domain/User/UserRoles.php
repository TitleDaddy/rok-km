<?php

namespace App\Domain\User;

enum UserRoles: string
{
    case ROLE_USER = 'ROLE_USER';
    case ROLE_ADMIN = 'ROLE_ADMIN';
}
