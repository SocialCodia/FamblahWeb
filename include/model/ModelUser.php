<?php

class ModelUser
{
    public $id, $name, $username, $email, $bio, $image, $status, $feedsCount, $friendsCount, $friendshipStatus;

    function __construct($data = array())
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getBio()
    {
        return $this->bio;
    }

    function getImage()
    {
        return $this->image;
    }

    function getStatus()
    {
        return $this->status;
    }

    function getFeedsCount()
    {
        return $this->feedsCount;
    }

    function getFriendsCount()
    {
        return $this->friendsCount;
    }

    function getFriendshipStatus()
    {
        return $this->friendshipStatus;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setBio($bio)
    {
        $this->bio = $bio;
    }

    function setImage($image)
    {
        $this->image = $image;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    function setFeedsCount($feedsCount)
    {
        $this->feedsCount = $feedsCount;
    }

    function setFriendsCount($friendsCount)
    {
        $this->friendsCount = $friendsCount;
    }

    function setFriendshipStatus($friendshipStatus)
    {
        $this->friendshipStatus = $friendshipStatus;
    }
}
?>