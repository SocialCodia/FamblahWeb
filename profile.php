<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>


    <?php
        $api = new Api;
        $feedsCard = $api->getFeeds();
        $hisId = null;
    ?>
    <?php
        if(isset($_POST['postFeed']))
        {
            $content = $_POST['content'];
            $file = $_FILES['file'];
            if (isset($_POST['feedPrivacy']))
                $feedPrivacy = $_POST['feedPrivacy'];
            else
                $feedPrivacy = 1;
            $responsePostFeed = $api->doPostFeed($content,$file,$feedPrivacy);
            if(!$responsePostFeed->error)
            {

            }
            else
            {
            }
        }
    ?>

<?php
    if (isset($_GET['u'])) 
    {
        $username = $_GET['u'];
    }
    else
    {
        $username = $mUser->getUsername();
    }
    $responseUser = $api->getUserByUsername($username);
    // print_r($responseUser);
    if (!$responseUser->error) 
    {
        $user = new ModelUser($responseUser->user);
        $friendshipStatus = $user->getFriendshipStatus();
        $status = $user->getStatus();
        $userId = $user->getId();
        $hisId = $user->getId();
        $hisName = $user->getName();
    }
    else
    {
        $user = new ModelUser();
        $user->setImage(USER_NOT_FOUND_IMAGE);
        $user->setName("User Not Found");
        $user->setUsername("UserNotFound");
        $user->setBio("User Not Found");
        $user->setFriendshipStatus(0);
        $user->setFeedsCount(0);
        $user->setFriendsCount(0);
        $friendshipStatus = 5;
    }
?>

    <?php
        //no use of it
        if(array_key_exists('btnAddFriend', $_POST)) { 
            $api->sendFriendRequest($userId);
        } 
        else if(array_key_exists('btnCancelFriendRequest', $_POST)) { 
            $api->cancelFriendRequest($userId);
        }
        else if(array_key_exists('btnUnfriend', $_POST)) { 
            $api->deleteFriend($userId);
        }
        else if(array_key_exists('btnAcceptFriendRequest', $_POST)) { 
            $api->acceptFriendRequest($userId);
        }
        else if(array_key_exists('btnRejectFriendRequest', $_POST)) { 
            $api->cancelFriendRequest($userId);
        }
        else if(array_key_exists('deleteFriend', $_POST)) { 
            $api->deleteFriend($userId);
        }
    ?> 

<?php

$verifiedHTML = '<i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>';

$btnEditProfileHTML = <<<HERE
<a href="editProfile" class="btn red darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;">Edit Profile</a>
HERE;

$btnBlockFriendHTML = <<<HERE
<Button class="btn red darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnBlockFriend" id="btnBlockFriend$userId" onclick="alertBlockFriend(this.value)" value="$userId">Block</Button>
HERE;

$btnUnBlockFriendHTML = <<<HERE
<Button class="btn red darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnUnBlockFriend" id="btnUnBlockFriend$userId" onclick="alertUnBlockFriend(this.value)" value="$userId">UnBlock</Button>
HERE;

$btnAddFriendHTML = <<<HERE
<Button class="btn blue lighten-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnAddFriend" id="btnAddFriend$userId" onclick="sendFriendRequest(this.value)" value="$userId">Add Friend +</Button>
HERE;

$btnCancelFriendRequestHTML = <<<HERE
<Button class="btn red darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnCancelFriendRequest" id="btnCancelFriendRequest$userId" onclick="alertCancelFriendRequest(this.value)" value="$userId">Cancel Request</Button>
HERE;

$btnUnfriendHTML = <<<HERE
<Button class="btn red darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnUnfriend" id="btnUnfriend$userId" onclick="alertDeleteFriend(this.value)" value="$userId">Unfriend</Button>
HERE;

$btnAcceptFriendRequestHTML = <<<HERE
<Button class="btn blue darken-2" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnAcceptFriendRequest" id="btnAcceptFriendRequest$userId" onclick="acceptFriendRequest(this.value)" value="$userId">Accept</Button>
HERE;

$btnRejectFriendRequestHTML = <<<HERE
<div class="col l6 m6 s6"><Button class="btn red darken-3" style="font-family:Rajdhani,sans-serif ; width: 80%; font-weight: bold; border-radius: 10px; height: 45px; line-height: 45px;  display:none;" name="btnRejectFriendRequest" id="btnRejectFriendRequest$userId" onclick="alertRejectFriendRequest(this.value)" value="$userId">Reject</Button>
HERE;
?>


<?php
    $feedsCard = $api->getFeedsByUsername();
?>
    <div class="socialcodia">
        <div class="row">
            <!-- *********************************Main Row offset 1 on both side, total row size is 10**************************************** -->
            <div class="col l12" style="padding:0px">
                <div class="card-mufazmi">
                    <img src="src/img/bg.jpg" class="responsive-img" style="height: 340px; width: 100%; object-fit:cover;" alt="">
                    <div class="card z-depth-0 center-align" style="margin-top: -8px;">
                            <div class="row" style="margin: 0px;">
                                <div class="col l4 s12 hide-on-med-and-down" style="font-weight: bold;">
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;"><?php echo $user->getFeedsCount(); ?></p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">Feeds</p>
                                    </div>
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;"><?php echo $user->getFriendsCount(); ?></p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">Friends</p>
                                    </div>
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;">999</p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">999</p>
                                    </div>
                                </div>

                                <div class="col l4 m12 s12">
                                    <img src="<?php echo $user->getImage();?>"  alt="" style="width:160px; height: 160px; object-fit: cover; margin-top: -110px; border: 6px solid white;" class="responsive-img circle z-depth-0">
                                    <h5 style="font-weight: bold; margin-top:0px; margin-bottom: 0px;"><?php echo $user->getName(); ?> <?php if($user->getStatus()==1) echo '<i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped  blue-text">check_circle</i>'; ?></h5>
                                    <p style="margin-top: 0px;"><b><?php echo "@".$user->getUsername(); ?></b></p>
                                </div>

                                <div class="col l4 s12 hide-on-large-only" style="font-weight: bold;">
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;"><?php echo $user->getFeedsCount(); ?></p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">Feeds</p>
                                    </div>
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;"><?php echo $user->getFriendsCount(); ?></p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">Friends</p>
                                    </div>
                                    <div class="col s4 m4 l4">
                                        <p style="font-size: 25px; margin-bottom: 0px;">999</p>
                                        <p style="font-size: 15px; color: #3e3f5e; margin-top: 0px;">999</p>
                                    </div>
                                </div>

                                <div class="col l4 s12" style="font-weight: bold; margin-top: 25px;">
                                    <div class="col l6 m6 s6">
                                    <?php
                                        if($user->getId()!=$_SESSION['id'])
                                        {
                                             echo $btnAddFriendHTML;
                                             echo $btnUnfriendHTML;
                                             echo $btnCancelFriendRequestHTML;
                                             echo $btnAcceptFriendRequestHTML;
                                    ?>
                                    </div>
                                    <?php
                                        echo $btnRejectFriendRequestHTML;
                                        echo $btnBlockFriendHTML;
                                        echo $btnUnBlockFriendHTML;
                                    ?>
                                        <div class="clearfix"></div>
                                    <?php
                                        }
                                        else
                                        {
                                            echo $btnEditProfileHTML;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="divider"></div>
                
                <div class=" col l1"></div>

                <!-- *****************************Middle Row For Post Content************************ -->
                <div class="col l7 m10 offset-m1 s12">
                        <!-- ********************Add Feed Card Design***************** -->
                            <div class="card" style="border-radius: 10px">
                                <div class="row">
                                    <div class="col s12 l12 m12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="card-content" style="padding: 5px;">
                                                <div class="row" style="margin-bottom: 0px;">
                                                    <div class="col s3 m2 l2 center" style="margin-top: 10px;">
                                                        <a href="<?php echo $mUser->getUsername(); ?>">
                                                            <img src="<?php echo $mUser->getImage();?>"  class="responsive-img circle" style=" border: 2px solid blue; margin-top: 5px; width: 60px; height: 60px; object-fit: cover;" alt="">
                                                        </a>                                                   
                                                    </div>
                                                    <div style="margin-bottom: -25px; padding-top: 15px;">
                                                        <p style="font-weight: bold;"><?php echo $mUser->getName(); if($mUser->getStatus() == 1) echo " ".$verifiedHTML; ?></p>
                                                    </div>
                                                    <div class="col s6 m3 l3" style="margin-left: -20px; margin-bottom: -5px;">
                                                      <div class="input-field col s12">
                                                        <select name="feedPrivacy">
                                                          <option value="1" data-icon="img/user.png">Public</option>
                                                          <option value="2" data-icon="img/user.png">Friends</option>
                                                          <option value="3" data-icon="img/user.png">Only Me!</option>
                                                        </select>
                                                      </div>     
                                                    </div>
                                                    <div class="col s12" style="margin-left: 0px; margin-bottom: -5px;">
                                                        <div class="input-field center" style="margin-bottom: -8px;">
                                                            <textarea name="content" id="" cols="30" rows="10" maxlength="1000" style="max-height: 250px; min-height: 90px; outline: none; border-bottom: none; width: 90%; margin: -20px 0px -30px 0px" class="materialize-textarea" placeholder="What's on your mind?" style="height: 100px;"></textarea>
                                                        </div>
                                                        <img src="" class="hoverable"  alt="" id="feedImage" style="width:100px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-action" style="padding: 8px;">
                                                <div class="row" style="margin: 0px;">
                                                    <input id="image" type="file" onchange="readURL(this);" name="file" class="hide"/>
                                                    <label for="image"><i class="material-icons prefix left blue-text" style="font-size: 30px; padding-left: 20px;">camera_alt</i></label>
                                                    <input type="submit" class="btn red right z-depth-0 blue" style="border-radius: 20px; height: 40px; width: 105px; margin-right: 20px;" name="postFeed" value="Post" id="postFeed">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- **************************Feed Data Will Show Into This Card********************** -->
                        <?php
                            if(!empty($feedsCard))
                            {
                                foreach($feedsCard as $feed)
                                {
                                    echo $feed;
                                }
                            }
                            else
                            {
                                echo "<h1>No Feeds Found</h1>";
                            
                            }
                        ?>
                </div>

                <!-- *************************************Right Row*********************************** -->
                <div class="col l4 m4 s12 hide-on-med-and-down">
                    <!-- ******************Designing About Section******************** -->
                    <div class="card z-depth-0 red lighten-2">
                        <div class="card-title center">
                            About me!
                        </div>
                        <div class="card-content">
                            <p><?php echo $user->getBio(); ?></p>
                        </div>
                    </div>
                    <!-- *****************Desgining All User Posted Images*********************** -->
                    <div class="card z-depth-0">
                        <div class="card-title center" >
                            <span>Images</span>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>                                <div class="col s4 m4 l4">
                                    <img src="src/img/mufazmi.jpg" alt="" class="responsive-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>