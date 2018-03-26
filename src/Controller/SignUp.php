<?php

namespace App\Controller;

use App\Form\Form;
use App\Response;
use App\Model\User;
use Error;
use App\Role\Role;

class Signup extends Sign
{
    
    /**
     * {@inheritDoc}
     * @see \App\Controller\Sign::sign()
     */
    protected function sign(): Response
    {
        $this->init(Role::USER);
        try {
            if (!$this->isValide($_SESSION["user"])) {
            } else if (!$this->post($_SESSION["user"])) {
                throw new Error(Form::ERR_USER_EXISTS);
            } else {
                $success = "Your acount have been created";
            }
        } catch (\Throwable $e) {
            
        }
        return $this->render("sign/sign.up.html.php", [
                "error" => isset($e) ? $e : null,
                "success" => isset($success) ? $success : null,
                "user" => $_SESSION["user"]
            ]
        );
    }

    /**
     * @throws \Error
     * @return bool
     */
    private function isValide(User $user): bool
    {
        $token = $user->token;
        if (!$user->hydrate(filter_input_array(INPUT_POST))) {
            return false;
        } else if ($user->token !== $token) {
            throw new Error(Form::ERR_TOKEN);
        } else if (!$user->email
                || !$user->pswd
                || !filter_input(INPUT_POST, Form::NAME_CONFIRM)) {
                throw new Error(Form::ERR_COMPLETE);
        } else if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            throw new Error(Form::ERR_EMAIL);
        } else if (!preg_match(Form::REGEX_PSWD, $user->pswd)) {
            throw new Error(Form::ERR_PSWD);
        } else if ($user->pswd !== filter_input(INPUT_POST, Form::NAME_CONFIRM)) {
            throw new Error(Form::ERR_CONFIRM);
        } 
        return true;
    }

}
