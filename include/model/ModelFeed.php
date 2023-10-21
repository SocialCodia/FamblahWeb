<?php

class ModelFeed
{
    public $feedId, $feedContent, $feedImage, $feedTimestamp, $userId, $userName, $userImage, $liked, $feedLikes, $feedComments;

    function __construct($data = array())
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    function getFeedId()
    {
        return $this->feedId;
    }

    function getFeedContent()
    {
        return $this->feedContent;
    }

    function getFeedImage()
    {
        return $this->feedImage;
    }

    function getFeedTimestamp()
    {
        return $this->feedTimestamp;
    }

    function getUserId()
    {
        return $this->userId;
    }

    function getUserName()
    {
        return $this->userName;
    }

    function getUserImage()
    {
        return $this->userImage;
    }

    function getLiked()
    {
        return $this->liked;
    }

    function getFeedLikes()
    {
        return $this->feedLikes;
    }

    function getFeedComments()
    {
        return $this->feedComments;
    }

    function setFeedId($feedId)
    {
        $this->feedId = $feedId;
    }

    function setFeedContent($feedContent)
    {
        $this->feedContent = $feedContent;
    }

    function setFeedImage($feedImage)
    {
        $this->feedImage = $feedImage;
    }

    function setFeedTimestamp($feedTimestamp)
    {
        $this->feedTimestamp = $feedTimestamp;
    }

    function setUserId($userId)
    {
        $this->userId = $userId;
    }

    function setUserName($userName)
    {
        $this->userName = $userName;
    }

    function setUserImage($userImage)
    {
        $this->userImage = $userImage;
    }

    function setLiked($liked)
    {
        $this->liked = $liked;
    }

    function setFeedLikes($feedLikes)
    {
        $this->feedLikes = $feedLikes;
    }

    function setFeedComments($feedComments)
    {
        $this->feedComments = $feedComments;
    }
}
?>