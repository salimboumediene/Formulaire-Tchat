<?php

namespace App\Controller\Api;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Response;
use App\Controller\Channel as ChannelController;
use App\Role\Role;
use App\Entity\Channel as ChannelEntity;
use App\DBH;
use App\Entity\ChannelMessage;
use App\Entity\Profile;
use Throwable;

class Channel extends ChannelController
{

    /**
     * @return Response
     */
    public function apiIndexAction(): Response
    {
        $this->init();
        $response = new Response();
        $response->addHeader("Content-Type", "application/json");
        if (Role::USER !== $_SESSION["user"]->role) {
            $response->setStatus(401, "Unauthorized");
        } else if (!($profile = $this->getProfile($_SESSION["user"]))
                || !($channel = $this->getChannel($profile))) {
            $response->setStatus(403, "Forbidden");
        } else if ("application/json" !== filter_input(INPUT_SERVER, "HTTP_ACCEPT")) {
            $response->setStatus(406, "Not Acceptable");
        } else if ("POST" === filter_input(INPUT_SERVER, "REQUEST_METHOD")){
            $this->post($channel, $profile)
          ? $response->setStatus(201, "Created")
          : $response->setStatus(400, "Bad Request");
        } else if ("GET" === filter_input(INPUT_SERVER, "REQUEST_METHOD")) {
            $normalizer = new GetSetMethodNormalizer;
            $normalizer->setIgnoredAttributes(["channelMessageId", "channel"]);
            $response->setBody(
                (new Serializer([$normalizer], [new JsonEncoder]))
                ->serialize($this->get($channel, $profile), "json"));
            $response->setStatus(200, "OK");
			// affiche les messages
		
        } else {
            $response->setStatus(405, "Method Not Allowed");
        }
        return $response;
    }

    /**
     * @param ChannelEntity $channel
     * @param Profile $profile
     * @return ChannelEntity[]
     */
    private function get (ChannelEntity $channel, Profile $profile)
    {
        return DBH::get()->getRepository(ChannelMessage::class)->findBy([
            "channel" => $channel
        ]);
    }

    /**
     * @param ChannelEntity $channel
     * @param Profile $profile
     * @return boolean
     */
    private function post (ChannelEntity $channel, Profile $profile)
    {
        try {
            $message = new ChannelMessage();
            $message->setChannel($channel);
            $message->setProfile($profile);
            $message->setTimestamp(time());
            $message->setMessage(filter_input(INPUT_POST, "message"));
            DBH::get()->persist($message);
            DBH::get()->flush();
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

}
