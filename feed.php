<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php require_once dirname(__FILE__).'/include/model/ModelFeed.php'; ?>

    <?php
        if (isset($_GET['feedId'])) 
        {
            $feedId = htmlentities($_GET['feedId']);
        }
        else
        {
            header("LOCATION:home");
        }

        if(!strlen($feedId)<1)
        {
            $api = new Api;
            $responseFeed = $api->getFeedById($feedId);
            $responseComment = $api->getCommentsByFeedId($feedId);
            if (!$responseComment->error)
            {
                $comments = $responseComment->comments;
            }
            if (!$responseFeed->error)
            {
                $modelFeed = new ModelFeed($responseFeed->feed);
                $feedId = $modelFeed->getFeedId();
            }
            else
            {
                echo '<h1 align="center">Feed Not Found</h1>';
                exit();
            }
        }
        else
        {
            echo '<h1 align="center">Feed Not Found</h1>';
            exit();
        }
    ?>


    <div class="socialcodia">
        <div class="row">
            <div class="col s12 m8 l8">
                <?php
                        $card = <<<HERE
                    <div class="card left-align" id="feedCard$modelFeed->feedId">
                    <div class="row">
                        <div class="col s3 m2 l2 center-align">
                            <a href="$modelFeed->userUsername">
                                <img src="$modelFeed->userImage" height="100" width="50" class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:50px; width:50px; object-fit:cover;" alt="">
                            </a>
                        </div>
                    HERE;

                    $card .= <<<HERE
                        <div class="col s7 m8 l8" style="margin-left: -20px;">
                            <p style="margin-top:10px;"><a href="$modelFeed->userUsername"><b class="black-text">$modelFeed->userName</b>
                    HERE;

                    if ($modelFeed->userStatus==1)
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>
                        HERE;
                    }

                    $card .= <<<HERE
                            </a></p>
                            <p style="margin-top:-15px;" class="grey-text small">$modelFeed->feedTimestamp 
                    HERE;

                    if ($modelFeed->feedPrivacy==1) 
                    {
                        $card .= <<<HERE
                           <i style="cursor:pointer;" data-position="right" data-tooltip="Public" class="material-icons tooltipped tiny blue-text">public</i>
                        HERE;
                    }
                    else if ($modelFeed->feedPrivacy==2) 
                    {
                        $card .= <<<HERE
                            <i style="cursor:pointer;" data-position="right" data-tooltip="$modelFeed->userName's Friends" class="material-icons tooltipped tiny blue-text">group</i>
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
                                <a href="" class="dropdown-trigger" data-target="postMoreDropdown$modelFeed->feedId"><i class="material-icons prefix tiny">more_vert</i></a>
                            </div>
                        </div>
                        <p style="margin-top: -20px; padding-left: 10px; padding-right: 10px;">$modelFeed->feedContent</p>
                    HERE;

            if ($modelFeed->feedType=="text") 
            {

            }
            else if ($modelFeed->feedType=="video") 
            {
                $card .= <<<HERE
                <video class="responsive-video" style="width:100%; max-height:400px" poster="$modelFeed->feedVideo" controls>
                    <source src="$modelFeed->feedVideo" type="video/mp4">
                </video>
                HERE;;
            }
            if ($modelFeed->feedType=="image") 
            {
                $card .= <<<HERE
                <img style="margin-top: -10px; padding:1px; width:100%; max-height:400px; object-fit: cover;" src="$modelFeed->feedImage" class="responsive-img" alt="">
                HERE;
            }
                $card .= <<<HERE
                <span class="grey-text darken-5" style="margin-left: 10px;" id="likescount$modelFeed->feedId"><b>$modelFeed->feedLikes</b> Likes</span>
                <span class="right grey-text darken-5" style="margin-right: 10px;"><b>$modelFeed->feedComments</b> Comments</span>
                <div class="card-action" style="padding: 10px;">
                    <div class="center">
                HERE;
                    $card .= <<<HERE
                        <Button class="left blue-text" id="like$modelFeed->feedId" onClick="doLike(this.value)" value="like$modelFeed->feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;

                    if($modelFeed->liked!=1)
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
                        <Button class="left red-text" id="unlike$modelFeed->feedId" onClick="doUnlike(this.value)" value="unlike$modelFeed->feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                    HERE;  

                    if($modelFeed->liked!=1)
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
                        <span class="center"><a href="feed?feedId=$modelFeed->feedId" class="blue-text"><i class="material-icons prefix tiny">comment</i><span style="padding: 5px;">Comment</span></a></span>
                        <span class="right"><a href="#" class="blue-text"><i class="material-icons prefix tiny">share</i><span style="padding: 5px;">Share</span></a></span>
                    </div>
                    HERE;

                $card .= <<<HERE
                    <div class="input-field " style="margin-bottom:-10px;padding: 0px 10px 0px 10px; display: flex;">
                        <img src="$mUserImage"class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:40px; width:40px; object-fit:cover; " alt="">
                          <textarea name="inputComment" id="inputComment" cols="30" rows="10" onkeydown="commentListener()" maxlength="1000" style="max-height: 70px; min-height: 20px;  border-radius: 20px; padding: 10px 20px 0px 20px; margin-right: 10px; margin-left: 10px;" class="materialize-textarea grey lighten-3" placeholder="Write a comment..."></textarea> 
                          <button id="btnComment" value="comment$feedId" style="border-radius: 20%; margin-top: 3px; display: none;" onclick="postComment();" class="btn"><i class="material-icons">send</i></button>
                    </div>
                    </div>
                    <div class="message-area" id="message-area">
                HERE;

                if (!empty($comments))
                {
                    foreach ($comments as $comment)
                    {
                        $userId = htmlentities($comment->userId);
                        $userName = htmlentities($comment->userName);
                        $userUsername = htmlentities($comment->userUsername);
                        $userImage = htmlentities($comment->userImage);
                        $liked = htmlentities($comment->liked);
                        $commentLikesCount = htmlentities($comment->commentLikesCount);
                        $commentId = htmlentities($comment->commentId);
                        $commentComment = htmlentities($comment->commentComment);
                        $commentTimestamp = htmlentities($comment->commentTimestamp);

                        $card .= <<<HERE
                            <div class="row" style="padding: 0px 5px 0px 5px;" >
                                <div class="col l1 m1 s2 center">
                                    <a href='$userUsername'><img src="$userImage"class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:40px; width:40px; object-fit:cover; " alt=""></a>
                                </div>
                                <div class="col s9 l10 m10" style="padding: 0px">
                                    <div class="grey lighten-3" style="border-radius: 10px; padding: 10px;">
                                        <a href='$userUsername'><b style="color:black">$userName</b></a><br><p style="margin-top: -5px">$commentTimestamp</p>
                                        <div>
                                            <p style="margin-top: -15px; margin-bottom: -5px; ">$commentComment</p>
                                        </div>
                                    </div>
                                    <div style="margin-left: 10px;">
                        HERE;

                                             $card .= <<<HERE
                                             <Button class="left blue-text" id="likecomment$commentId" onClick="likeComment(this.value)" value="likecomment$commentId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                                             HERE;

                                            if (!$liked)
                                            {
                                                $card .= 'display:block;';
                                            }
                                            else
                                            {
                                                $card .= 'display:none;';
                                            }

                                             $card .= <<<HERE
                                             "><i class="material-icons prefix tiny">thumb_up</i> Like</Button>
                                             HERE;

                                            $card .= <<<HERE
                                             <Button class="left red-text" id="unlikecomment$commentId" onClick="unlikeComment(this.value)" value="unlikecomment$commentId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;
                                             HERE;

                                            if ($liked)
                                            {
                                                $card .= 'display:block;';
                                            }
                                            else
                                            {
                                                $card .= 'display:none;';
                                            }

                                            $card .= <<<HERE
                                             "><i class="material-icons prefix tiny">thumb_up</i> Unlike</Button>
                                             HERE;


                                         $card .= <<<HERE
                                         <b style="padding:5px;" id="likecommetcounts$commentId" value="$commentId" ">$commentLikesCount</b>
                                    </div>
                                </div>
                            </div>
                        HERE;
                    }
                }



                $card .=<<<HERE
                </div>
                <ul id='postMoreDropdown$modelFeed->feedId' coverTrigger="true" class='dropdown-content'>
                    <li><Button  value="delete$modelFeed->feedId" id="delete$modelFeed->feedId" onClick="deleteFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Delete</Button></li>
                    <li><Button value="report$modelFeed->feedId" id="report$modelFeed->feedId" onClick="reportFeed(this.value)" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;font-size: 16px; color: #26a69a; display: block; line-height: 22px; padding: 14px 16px;">Report</Button></li>
                </ul>
                </div>
                HERE;

                echo $card;
                ?>
            </div>
        </div>
    </div>


<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>