<?php

namespace App\Controller;

use App\Response;
use App\Role\Role;
use App\Form\Form;
use Throwable;
use App\DBH;
use App\Entity\Profile;
use App\Entity\Channel;
use App\Model\User;
use Error;

class Home extends Controller
{

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $this->init();
        if (Role::USER !== $_SESSION["user"]->role) {
            return $this->renderDefaultHome();
        }
        try {
            if (filter_input_array(INPUT_GET)
             && filter_input(INPUT_GET, "action")
             && $this->delete($_SESSION["user"])) {
                 return $this->redirectToUrl("/formation-php/web/");
            } else if (!$this->isValide($_SESSION["user"])) {
            } else if ($this->put($_SESSION["user"])){
                $success = "Channel created";
            }
        } catch (Throwable $e) {
        }
        $channels = $this->get($_SESSION["user"]);
        return $this->render("channel/owner.html.php", [
            "user" => $_SESSION["user"],
            "error" => isset($e) ? $e : null,
            "success" => isset($success) ? $success : null,
            "channels" => isset($channels) ? $channels : [],
        ]);
    }

    /**
     * @return \App\Response
     */
    private function renderDefaultHome()
    {
        return $this->render("home.html.php", [
            "user" => $_SESSION["user"]
        ]);
    }

    /**
     * @param User $user
     * @return array
     */
    private function get(User $user): array
    {
        return DBH::get()
        ->getRepository(Channel::class)
        ->findBy([
            "profile" => DBH::get()->find(Profile::class, $user->id)
        ]);
    }

    /**
     * @param User $user
     * @return array
     */
    private function delete(User $user)
    {
        $channel = DBH::get()
        ->getRepository(Channel::class)
        ->findOneBy([
            "channelId" => filter_input(INPUT_GET, Form::NAME_CHANNEL_ID),
            "profile" => DBH::get()->find(
                Profile::class, $user->id
        )]);
        if (!$channel) {
            throw new Error("Channel does not exists");
        }
        DBH::get()->remove($channel);
        DBH::get()->flush();
        return true;
    }

    /**
     * @param User $user
     * @return bool
     * @throws Throwable
     */
    private function put (User $user): bool
    {
        try {
            $profile = DBH::get()->find(Profile::class, $user->id);
            $channel = new Channel();
            $channel->setChannelName(filter_input(INPUT_POST, Form::NAME_CHANNEL_NAME));
            $channel->setChannelDescr(filter_input(INPUT_POST, Form::NAME_CHANNEL_DESCR));
            $channel->setChannelCapacity(filter_input(INPUT_POST, Form::NAME_CHANNEL_CAPACITY));
            $channel->setProfile($profile);
            DBH::get()->persist($channel);
            DBH::get()->flush();
            return true;
        } catch (Throwable $e) {
            throw new Error("A channel already have this name");
        }
    }

    /**
     * @throws \Error
     * @return bool
     */
    private function isValide($user)
    {
        if (!filter_input_array(INPUT_POST)) {
            return false;
        } else if ($user->token !== filter_input(INPUT_POST, "token")) {
            throw new Error(Form::ERR_TOKEN);
        } else if (!filter_input(INPUT_POST, Form::NAME_CHANNEL_NAME)
                || !filter_input(INPUT_POST, Form::NAME_CHANNEL_DESCR)
                || !filter_input(INPUT_POST, Form::NAME_CHANNEL_CAPACITY)) {
            throw new Error(Form::ERR_COMPLETE);
        }
        return true;
    }

}
