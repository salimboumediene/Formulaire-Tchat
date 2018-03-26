<?php

namespace App\Controller;

use App\Response;
use App\Role\Role;

class SignOut extends Sign
{

    /**
     * {@inheritDoc}
     * @see \App\Controller\Sign::sign()
     */
    protected function sign(): Response
    {
        $this->init();
        $this->updateRoles($_SESSION["user"], Role::VISITOR);
        $this->revoke();
        return $this->redirectToUrl("/formation-php/web/");
    }

}
