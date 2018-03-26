<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChannelMessage
 *
 * @ORM\Table(name="channel_message", indexes={@ORM\Index(name="profile_id", columns={"profile_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class ChannelMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="channel_message_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelMessageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @var \App\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="channel_id")
     * })
     */
    private $channel;

    /**
     * @var \App\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="profile_id")
     * })
     */
    private $profile;



    /**
     * Get channelMessageId
     *
     * @return integer
     */
    public function getChannelMessageId()
    {
        return $this->channelMessageId;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     *
     * @return ChannelMessage
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return ChannelMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set channel
     *
     * @param \App\Entity\Channel $channel
     *
     * @return ChannelMessage
     */
    public function setChannel(\App\Entity\Channel $channel = null)
    {
        $this->channel = $channel;
    
        return $this;
    }

    /**
     * Get channel
     *
     * @return \App\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set profile
     *
     * @param \App\Entity\Profile $profile
     *
     * @return ChannelMessage
     */
    public function setProfile(\App\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
    
        return $this;
    }

    /**
     * Get profile
     *
     * @return \App\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
