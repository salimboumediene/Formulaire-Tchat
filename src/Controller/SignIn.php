<?php

namespace App\Controller;

use App\Response;
use App\Form\Form;
use Error;
use App\Model\User;
use App\Role\Role;

class SignIn extends Sign
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
            } else if (!password_verify(
                $_SESSION["user"]->pswd,
                $this->selectPassword($_SESSION["user"]
            ))) {
                throw new \Error(Form::ERR_CREDENTIALS);
            } else {
                $this->updateRoles($_SESSION["user"], Role::USER);
                $_SESSION["user"]->id = $this->selectProfileId($_SESSION["user"]);
                $_SESSION["user"]->email = null;
                $_SESSION["user"]->pswd = null;
                $success = "Your are logged in";
            }
        } catch (\Throwable $e) {
        }
        return $this->render(
            "sign/sign.in.html.php", [
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
        } else if (!$user->email || !$user->pswd) {
            throw new Error(Form::ERR_COMPLETE);
        } else if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)
                || !preg_match(Form::REGEX_PSWD, $user->pswd)) {
            throw new Error(Form::ERR_CREDENTIALS);
        }
        return true;
    }

}
