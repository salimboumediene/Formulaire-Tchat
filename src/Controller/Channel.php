<?php

namespace App\Controller;

use App\Response;
use App\Entity\Profile;
use App\Entity\Channel as ChannelEntity;
use App\DBH;
use App\Role\Role;
use App\Form\Form;
use App\Model\User;
use App\Entity\ChannelProfile;
use Throwable;
use Error;

class Channel extends Controller
{

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $this->init();
        if (Role::USER !== $_SESSION["user"]->role) {
            throw new Error("Can not access to user pages");
        }
        try {
            if (!($channel = $this->getChannel($this->getProfile($_SESSION["user"])))) {
                throw new Error("Can not access to this channel");
            }
        } catch (Throwable $e) {
            return $this->redirectToUrl("/formation-php/web/");
        }
        return $this->render("channel/channel.html.php", [
            "user" => $_SESSION["user"],
            "channel" => $channel
        ]);
    }

    /**
     * @param User $user
     * @return ChannelEntity|NULL
     */
    protected function getProfile (User $user)
    {
        return DBH::get()->find(Profile::class, $user->id);
    }

    /**
     * @param Profile $profile
     * @return ChannelEntity|NULL
     */
    protected function getChannel(Profile $profile)
    {
        return !($channel = $this->getOwnerChannel($profile))
             ? $this->getSubscriberChannel($profile)
             : $channel;
    }

    /**
     * @param Profile $profile
     * @return ChannelEntity|NULL
     */
    protected function getOwnerChannel (Profile $profile)
    {
        return DBH::get()->getRepository(ChannelEntity::class)
        ->findOneBy([
            "channelId" => filter_input(INPUT_GET, Form::NAME_CHANNEL_ID),
            "profile" => $profile   
        ]);
    }

    /**
     * @param Profile $profile
     * @return ChannelEntity|NULL
     */
    protected function getSubscriberChannel (Profile $profile)
    {
        return DBH::get()->getRepository(ChannelProfile::class)
        ->findOneBy([
            "channel" => DBH::get()->find(
                ChannelEntity::class, filter_input(INPUT_GET, Form::NAME_CHANNEL_ID)
             ),
            "profile" => $profile
        ])->getChannel();
    }

}
