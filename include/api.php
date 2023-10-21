<?php

require_once dirname(__FILE__).'/Constants.php';
require_once dirname(__FILE__).'/model/ModelUser.php';
require_once dirname(__FILE__).'/model/ModelVideo.php';
$apiUrl = API_URL;

class Api
{

    function doLogin($email,$password)
    {
        $endPoint = '/login';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"email=$email&password=$password");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

    function doForgotPassword($email)
    {
        $endPoint = '/forgotPassword';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"email=$email");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

    function doChangePassword($password,$newPassword)
    {
        if (isset($_COOKIE['token'])) 
        {
            $token = $_COOKIE['token'];
        }
        $header[] = "token: $token";
        $endPoint = '/updatePassword';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"password=$password&newpassword=$newPassword");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

    function doResetPassword($email,$otp,$newPassword)
    {
        $otp = str_replace(' ','',$otp);
        $endPoint = '/resetPassword';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"email=$email&otp=$otp&newPassword=$newPassword");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

    function doUpdateUser($name,$username,$image,$bio)
    {
        if (isset($_COOKIE['token'])) 
        {
            $token = $_COOKIE['token'];
        }
        $header[]= "Content-Type:multipart/form-data";
        $header[] = "token: $token";
        $endPoint = '/user/update';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        if (isset($image) && !empty($image['tmp_name']))
        {
            $image = $image['tmp_name'];
            $image = new CURLFile($image);
        }
        else
        {
            $image = "";
        }
        $postField = array('name'=>$name,'username'=>$username,'image'=>$image,'bio'=>$bio);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postField);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);   
        return $response;
        echo "<script>window.location.reload();</script>";
    }

    function doPostFeed($content,$file,$feedPrivacy)
    {
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $header[]= "Content-Type:multipart/form-data";
        $header[] = "token: $tokenCookie";
        if (isset($file) && !empty($file['tmp_name']))
        {
            if ($file['type']=="image/png" || $file['type']=="image/jpg" || $file['type']=="image/jpeg") 
            {
                $file = $file['tmp_name'];
                $file = new CURLFile($file,'image/png', 'filename.png');
            }
            else if ($file['type']=="video/mp4") 
            {
                $file = $file['tmp_name'];
                $file = new CURLFile($file,'video/mp4', 'filename.mp4');
            }
            else
                $file = "";
        }
        else
            $file = "";

        if (!isset($feedPrivacy)) 
        {
            $feedPrivacy = 1;
        }
        $postField = array('file'=>$file,'content'=>$content,'feedPrivacy'=>$feedPrivacy);
        $endPoint = 'feed/post';
        $url = API_URL.$endPoint;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postField);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        // header("Refresh:0");
        return $response;
    }

    function sendFriendRequest($userId)
    {
        $domain = API_URL;
        $endPoint = "sendFriendRequest";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "userId=$userId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    function acceptFriendRequest($userId)
    {
        $domain = API_URL;
        $endPoint = "acceptFriendRequest";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "userId=$userId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    function cancelFriendRequest($userId)
    {
        $domain = API_URL;
        $endPoint = "cancelFriendRequest";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "userId=$userId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    function deleteFriend($userId)
    {
        $domain = API_URL;
        $endPoint = "deleteFriend";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "userId=$userId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    function getUser()
    {
        return $this->getMethodApi("user");
    }

    function getNotifications()
    {
        return $this->getMethodApi("notifications");
    }

    function getUserByUserName($username)
    {
        $domain = API_URL;
        $endPoint = "user/";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint.$username;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    function getFriends($username)
    {
        $endPoint = "user/".$username."/friends";
        return $this->getMethodApi($endPoint);
    }

    function getUsers()
    {
        return $this->getMethodApi("users");
    }

    function getCommentsByFeedId($feedId)
    {
        return $this->getMethodApi("feed/".$feedId."/comments");
    }

    function getImages($username)
    {
        $endPoint = "user/".$username."/images";
        return $this->getMethodApi($endPoint);
    }

    function getVideo($videoId)
    {
        $endPoint = "video/".$videoId;
        return $this->getMethodApi($endPoint);
    }

    function getVideos()
    {
        return $this->getMethodApi("videos");
    }

    function getFeedsByUsername()
    {
        $domain = API_URL;
        $endPoint = "feeds";
        if(isset($_GET['u']))
        {
            $username = $_GET['u'];
        }
        else
        {
            $username = $_SESSION['username'];
        }
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain."user/".$username.'/'.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        // print_r($response);
        if(!$response->error)
        {
            $feeds = $response->feeds;

            $feedsCard = array();
        
        foreach($feeds as $feedLists)
        {
            $card = "";
                    $userId = htmlentities($feedLists->userId);
                    $userName = htmlentities($feedLists->userName);
                    $userUsername = htmlentities($feedLists->userUsername);
                    $userImage = htmlentities($feedLists->userImage);
                    $userStatus = htmlentities($feedLists->userStatus);
                    $feedId = htmlentities($feedLists->feedId);
                    $liked = htmlentities($feedLists->liked);
                    $feedLikes = htmlentities($feedLists->feedLikes);
                    $feedComments = htmlentities($feedLists->feedComments);
                    $feedType = htmlentities($feedLists->feedType);
                    $feedPrivacy = htmlentities($feedLists->feedPrivacy);
                    $feedContent = htmlentities($feedLists->feedContent);
                    $feedTimestamp = htmlentities($feedLists->feedTimestamp);

                    $card = <<<HERE
                    <div class="card left-align z-depth-1" style="border-radius:10px 10px 0px 0px;" id="feedCard$userId">
                    <div class="row">
                        <div class="col s3 m2 l2 center-align">
                            <a href="$userUsername">
                                <img src="$userImage" height="100" width="50" class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:50px; width:50px; object-fit:cover;" alt="">
                            </a>
                        </div>
                    HERE;

                    $card .= <<<HERE
                        <div class="col s7 m8 l8" style="margin-left: -20px;">
                            <p style="margin-top:10px;"><a href="$userUsername"><b class="black-text">$userName</b>
                    HERE;

                    if ($userStatus==1)
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>
                        HERE;
                    }

                    $card .= <<<HERE
                            </a></p>
                            <p style="margin-top:-15px;" class="grey-text small">$feedTimestamp 
                    HERE;

                    if ($feedPrivacy==1) 
                    {
                        $card .= <<<HERE
                           <i style="cursor:pointer;" data-position="right" data-tooltip="Public" class="material-icons tooltipped tiny blue-text">public</i>
                        HERE;
                    }
                    else if ($feedPrivacy==2) 
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="$userName's Friends" class="material-icons tooltipped tiny blue-text">group</i>
                        HERE;
                    }
                    else 
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="Private" class="material-icons tooltipped tiny blue-text">lock</i>
                        HERE;
                    }

                    $card .= <<<HERE
                            </p>
                        </div>
                    HERE;



                    $card .= <<<HERE
                        <div class="col s2 m2 l2 right-align" style=" padding:20px;">
                                <a href="" class="dropdown-trigger" data-target="postMoreDropdown$feedId"><i class="material-icons prefix tiny">more_vert</i></a>
                            </div>
                        </div>
                        <p style="margin-top: -20px; padding-left: 10px; padding-right: 10px;">$feedContent</p>
                    HERE;

            if ($feedType=="text") 
            {

            }
            else if ($feedType=="video") 
            {
                $card .= <<<HERE
                <video class="responsive-video" style="width:100%; max-height:400px" poster="$feedLists->feedVideo" controls>
                    <source src="$feedLists->feedVideo" type="video/mp4">
                </video>
                HERE;;
            }
            if ($feedType=="image") 
            {
                $card .= <<<HERE
                <img style="margin-top: -10px; padding:1px; width:100%; max-height:400px; object-fit: cover;" src="$feedLists->feedImage" class="responsive-img" alt="">
                HERE;
            }
                $card .= <<<HERE
                <span class="grey-text darken-5" style="margin-left: 10px;" id="likescount$feedId"><b>$feedLikes</b> Likes</span>
                <span class="right grey-text darken-5" style="margin-right: 10px;"><b>$feedComments</b> Comments</span>
                <div class="card-action" style="padding: 10px;">
                    <div class="center">
                HERE;
                    $card .= <<<HERE
                        <Button class="left blue-text" id="like$feedId" onClick="doLike(this.value)" value="like$feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;

                    if($liked!=1)
                    {
                      $card .= <<<HERE
                        display: block;"><i class="material-icons prefix tiny blue-text">thumb_up</i> Like
                      HERE;
                    }
                    else
                    {
                      $card .= <<<HERE
                        display: none;"><i class="material-icons prefix tiny blue-text">thumb_up</i> Like
                      HERE;
                    }
             
                    $card .= <<<HERE
                        <Button class="left red-text" id="unlike$feedId" onClick="doUnlike(this.value)" value="unlike$feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;  

                    if($liked!=1)
                    {
                      $card .= <<<HERE
                        display: none;"><i class="material-icons prefix tiny">thumb_up</i> Liked
                      HERE;
                    }
                    else
                    {
                      $card .= <<<HERE
                        display: block;"><i class="material-icons prefix red-text tiny">thumb_up</i> Liked
                      HERE;
                    }

                    $card .= <<<HERE
                      </Button>
                    HERE;
                $card .= <<<HERE
                        <span class="center"><a href="feed?feedId=$feedId" class="blue-text"><i class="material-icons prefix tiny">comment</i><span style="padding: 5px;">Comment</span></a></span>
                        <span class="right"><a href="#" class="blue-text"><i class="material-icons prefix tiny">share</i><span style="padding: 5px;">Share</span></a></span>
                    </div>
                </div>
                <ul id='postMoreDropdown$feedId' coverTrigger="true" class='dropdown-content'>
                    <li><Button  value="delete$feedId" id="delete$feedId" onClick="deleteFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Delete</Button></li>
                    <li><Button value="report$feedId" id="report$feedId" onClick="reportFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Report</Button></li>
                </ul>
                </div>
                HERE;
                array_push($feedsCard, $card);
        }
            curl_close($ch);
            return $feedsCard;
        }
    }   

    function getFeedById($feedId)
    {
        $endPoint = "feed/".$feedId;
        return $this->getMethodApi($endPoint);
    }   

    function getFeeds()
    {
        $domain = API_URL;
        $endPoint = "feeds";
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        // print_r($response);
        $feeds = $response->feeds;
        $feedsCard = array();

        foreach($feeds as $feedLists)
        {
            $card = "";
                    $userId = htmlentities($feedLists->userId);
                    $userName = htmlentities($feedLists->userName);
                    $userUsername = htmlentities($feedLists->userUsername);
                    $userImage = htmlentities($feedLists->userImage);
                    $userStatus = htmlentities($feedLists->userStatus);
                    $feedId = htmlentities($feedLists->feedId);
                    $liked = htmlentities($feedLists->liked);
                    $feedLikes = htmlentities($feedLists->feedLikes);
                    $feedComments = htmlentities($feedLists->feedComments);
                    $feedType = htmlentities($feedLists->feedType);
                    $feedPrivacy = htmlentities($feedLists->feedPrivacy);
                    $feedContent = htmlentities($feedLists->feedContent);
                    $feedTimestamp = htmlentities($feedLists->feedTimestamp);
                    $card = <<<HERE
                    <div class="card left-align z-depth-1" style="border-radius:10px 10px 0px 0px;" id="feedCard$feedId">
                    <div class="row">
                        <div class="col s3 m2 l2 center-align">
                            <a href="$userUsername">
                                <img src="$userImage" height="100" width="50" class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:50px; width:50px; object-fit:cover;" alt="">
                            </a>
                        </div>
                    HERE;

                    $card .= <<<HERE
                        <div class="col s7 m8 l8" style="margin-left: -20px;">
                            <p style="margin-top:10px;"><a href="$userUsername"><b class="black-text">$userName</b>
                    HERE;

                    if ($userStatus==1)
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>
                        HERE;
                    }

                    $card .= <<<HERE
                            </a></p>
                            <p style="margin-top:-15px;" class="grey-text small">$feedTimestamp 
                    HERE;

                    if ($feedPrivacy==1) 
                    {
                        $card .= <<<HERE
                           <i style="cursor:pointer;" data-position="right" data-tooltip="Public" class="material-icons tooltipped tiny blue-text">public</i>
                        HERE;
                    }
                    else if ($feedPrivacy==2) 
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="$userName's Friends" class="material-icons tooltipped tiny blue-text">group</i>
                        HERE;
                    }
                    else 
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="Private" class="material-icons tooltipped tiny blue-text">lock</i>
                        HERE;
                    }

                    $card .= <<<HERE
                            </p>
                        </div>
                    HERE;



                    $card .= <<<HERE
                        <div class="col s2 m2 l2 right-align" style=" padding:20px;">
                                <a href="" class="dropdown-trigger" data-target="postMoreDropdown$feedId"><i class="material-icons prefix tiny">more_vert</i></a>
                            </div>
                        </div>
                        <p style="margin-top: -20px; padding-left: 10px; padding-right: 10px;">$feedContent</p>
                    HERE;

            if ($feedType=="text") 
            {

            }
            else if ($feedType=="video") 
            {
                $card .= <<<HERE
                <video class="responsive-video" style="width:100%; max-height:400px" poster="$feedLists->feedVideo" controls>
                    <source src="$feedLists->feedVideo" type="video/mp4">
                </video>
                HERE;;
            }
            if ($feedType=="image") 
            {
                $card .= <<<HERE
                <img style="margin-top: -10px; padding:1px; width:100%; max-height:400px; object-fit: cover;" src="$feedLists->feedImage" class="responsive-img" alt="">
                HERE;
            }
                $card .= <<<HERE
                <span class="grey-text darken-5" style="margin-left: 10px;" id="likescount$feedId"><b>$feedLikes</b> Likes</span>
                <span class="right grey-text darken-5" style="margin-right: 10px;"><b>$feedComments</b> Comments</span>
                <div class="card-action" style="padding: 10px;">
                    <div class="center">
                HERE;
                    $card .= <<<HERE
                        <Button class="left blue-text" id="like$feedId" onClick="doLike(this.value)" value="like$feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;

                    if($liked!=1)
                    {
                      $card .= <<<HERE
                        display: block;"><i class="material-icons prefix tiny blue-text">thumb_up</i> Like
                      HERE;
                    }
                    else
                    {
                      $card .= <<<HERE
                        display: none;"><i class="material-icons prefix tiny blue-text">thumb_up</i> Like
                      HERE;
                    }
             
                    $card .= <<<HERE
                        <Button class="left red-text" id="unlike$feedId" onClick="doUnlike(this.value)" value="unlike$feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;  

                    if($liked!=1)
                    {
                      $card .= <<<HERE
                        display: none;"><i class="material-icons prefix tiny">thumb_up</i> Liked
                      HERE;
                    }
                    else
                    {
                      $card .= <<<HERE
                        display: block;"><i class="material-icons prefix red-text tiny">thumb_up</i> Liked
                      HERE;
                    }

                    $card .= <<<HERE
                      </Button>
                    HERE;
                $card .= <<<HERE
                        <span class="center"><a href="feed?feedId=$feedId" class="blue-text"><i class="material-icons prefix tiny">comment</i><span style="padding: 5px;">Comment</span></a></span>
                        <span class="right"><a href="#" class="blue-text"><i class="material-icons prefix tiny">share</i><span style="padding: 5px;">Share</span></a></span>
                    </div>
                </div>
                <ul id='postMoreDropdown$feedId' coverTrigger="true" class='dropdown-content'>
                    <li><Button  value="delete$feedId" id="delete$feedId" onClick="deleteFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Delete</Button></li>
                    <li><Button value="report$feedId" id="report$feedId" onClick="reportFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Report</Button></li>
                </ul>
                </div>
                HERE;
                array_push($feedsCard, $card);
        }
        curl_close($ch);
        return $feedsCard;
    }

    function getMethodApi($endPoint)
    {
        $domain = API_URL;
        $endPoint = $endPoint;
        if (isset($_COOKIE['token'])) 
        {
            $tokenCookie = $_COOKIE['token'];
        }
        $url = $domain.$endPoint;
        $header[] = "token: $tokenCookie";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }


}
?>


