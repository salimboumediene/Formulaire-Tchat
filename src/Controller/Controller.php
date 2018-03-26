<?php

namespace App\Controller;

use App\Response;
use InvalidArgumentException;
use App\Model\User;
use App\Role\Role;

class Controller
{

    /**
     * @param string $view
     * @param array $parameters
     * @throws \InvalidArgumentException
     * @return \App\Response
     */
    protected function render (
        string $view,
        array $parameters = []
    )
    {
        $filename = __DIR__ . "/../Ressources/views/" . $view;
        if (!is_readable($filename)) {
            throw new InvalidArgumentException(
                "The views file is not readable"
            );
        }
        extract($parameters);
        ob_start();
        include $filename;
        $output = ob_get_contents();
        ob_end_clean();
        $response = new Response();
        $response->setBody($output);
        return $response;
    }

    /**
     * @param string $role
     * @return boolean
     */
    protected function init (string $role = null)
    {
        session_start();
        if (!array_key_exists("user", $_SESSION)) {
            $user = new User();
            $user->agent = filter_input(INPUT_SERVER, "HTTP_USER_AGENT");
            $user->ip = filter_input(INPUT_SERVER, "REMOTE_ADDR");
            $user->timestamp = time();
            $user->token = md5(uniqid(uniqid(), true));
            $user->role = Role::VISITOR;
            $_SESSION["user"] = $user;
            return true;
        } else if ($role) {
            if ($role === $_SESSION["user"]->role) {
                return $this->redirectToUrl("/formation-php/web/");
            }
        }
        return $this->authorize();
    }

    /**
     * @throws \RuntimeException
     * @return boolean
     */
    protected function authorize ()
    {
        if ($_SESSION["user"]->agent !== filter_input(INPUT_SERVER, "HTTP_USER_AGENT")
         || $_SESSION["user"]->ip !== filter_input(INPUT_SERVER, "REMOTE_ADDR")) {
             $this->revoke();
             throw new \RuntimeException("Auhtorization faillure");
        }
        return true;
    }
    
    /**
     * @return boolean
     */
    protected function revoke ()
    {
        return session_destroy();
    }

    /**
     * @param string $url
     * @return Response
     */
    protected function redirectToUrl(string $url): Response
    {
        $response = new Response;
        $response->addHeader("Location", $url);
        return $response;
    }

}

