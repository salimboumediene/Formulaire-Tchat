<?php

namespace App\Role;

interface Role
{

    const
        /**
         * @var int
         */
        SUPERADMIN = 1,
        /**
         * @var int
         */
        ADMIN = 2,
        /**
         * @var int
         */
        USER = 3,
        /**
         * @var int
         */
        VISITOR = 4;

}
