<?php

class ModelVideo
{
    public $videoId, $userId, $videoTitle, $videoDesc, $videoImage, $videoUrl, $timestamp, $userName, $userImage, $userUsername;

    function __construct($data = array())
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    function getVideoId()
    {
        return $this->videoId;
    }

    function getUserId()
    {
        return $this->userId;
    }

    function getVideoTitle()
    {
        return $this->videoTitle;
    }

    function getVideoDesc()
    {
        return $this->videoDesc;
    }

    function getVideoImage()
    {
        return $this->videoImage;
    }

    function getVideoUrl()
    {
        return $this->videoUrl;
    }

    function getTimestamp()
    {
        return $this->timestamp;
    }

    function getUserName()
    {
        return $this->userName;
    }

    function getUserImage()
    {
        return $this->userImage;
    }

    function getUserUsername()
    {
        return $this->userUsername;
    }

    function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }

    function setUserId($userId)
    {
        $this->userId = $userId;
    }

    function setVideoTitle($videoTitle)
    {
        $this->videoTitle = $videoTitle;
    }

    function setVideoDesc($videoDesc)
    {
        $this->videoDesc = $videoDesc;
    }

    function setVideoImage($videoImage)
    {
        $this->videoImage = $videoImage;
    }

    function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }

    function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    function setUserName($userName)
    {
        $this->userName = $userName;
    }

    function setUserImage($userImage)
    {
        $this->userImage = $userImage;
    }

    function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;
    }
}
?>