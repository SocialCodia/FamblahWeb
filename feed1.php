<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php require_once dirname(__FILE__).'/include/model/ModelFeed.php'; ?>

    <?php
        if (isset($_GET['feedId']) ) 
        {
            $feedId = htmlentities($_GET['feedId']);
            print_r(is_numeric($feedId));
        }
        else
        {
            header("LOCATION:home");
        }

        $api = new Api;
        $responseFeed = $api->getFeedById($feedId);
        if (!$responseFeed->error)
        {
            $modelFeed = new ModelFeed($responseFeed->feed);
        }
        else
        {
            echo '<h1 align="center">Feed Not Found</h1>';
            // exit();
        }
    ?>

    <div class="socialcodia">
        <div class="row">
            <div class="col m12 m8 l8">
                <div class="card  left-align">
                    <div class="row">
                        <div class="col s3 m2 l2 center-align">
                            <a href="<?php echo $modelFeed->getUserName(); ?>">
                                <img src="<?php echo $modelFeed->getUserImage(); ?>" height="100" width="50" class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:50px; width:50px; object-fit:cover;" alt="">
                            </a>
                        </div>
                        <div class="col s7 m8 l8" style="margin-left: -20px;">
                            <p style="margin-top:10px;"><a href="<?php echo $modelFeed->getUserName(); ?>"><b class="black-text"><?php echo $modelFeed->getUserName(); ?></b></a></p>
                            <p style="margin-top:-15px;" class="grey-text small"><?php echo $modelFeed->getFeedTimestamp(); ?></p>
                        </div>
                        <div class="col s2 m2 l2 right-align" style=" padding:20px;">
                            <a href="" class="dropdown-trigger" data-target="postMoreDropdown"><i class="material-icons prefix tiny">more_vert</i></a>
                        </div>
                    </div>
                    <p style="margin-top: -20px; padding-left: 10px; padding-right: 10px;"><?php echo $modelFeed->getFeedContent(); ?></p>
                    <img style="margin-top: -10px; padding:1px; width:100%;  object-fit: cover;" src="<?php echo $modelFeed->getFeedImage(); ?>" class="responsive-img" alt="">
                    <span class="grey-text darken-5" style="margin-left: 10px;"><?php echo $modelFeed->getFeedLikes(); ?> Likes</span>
                    <span class="right grey-text darken-5" style="margin-right: 10px;"><?php echo $modelFeed->getFeedComments(); ?> Comments</span>
                    <div class="card-action" style="padding: 10px;">
                        <div class="center">
                            <span class="left"><a href="#" class="blue-text"><i class="material-icons prefix tiny">thumb_up</i><span style="padding: 5px;">Like</span></a></span>
                            <span class="center"><a href="#" class="red-text"><i class="material-icons prefix tiny">comment</i><span style="padding: 5px;">Comment</span></a></span>
                            <span class="right"><a href="#" class="blue-text"><i class="material-icons prefix tiny">share</i><span style="padding: 5px;">Share</span></a></span>
                        </div>
                    </div>
                    <div class="input-field " style="margin:0px;padding: 0px 10px 0px 10px; display: flex;">
                        <img src="<?php echo $mUser->getImage(); ?>"class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:40px; width:40px; object-fit:cover; " alt="">

                          <textarea name="inputComment" id="inputComment" cols="30" rows="10" onkeydown="commentListener()" maxlength="1000" style="max-height: 70px; min-height: 20px;  border-radius: 20px; padding: 10px 20px 0px 20px; margin-right: 10px; margin-left: 10px;" class="materialize-textarea grey lighten-3" placeholder="Write a comment..."></textarea> 
                          <button id="btnComment" style="border-radius: 20%; margin-top: 3px; display: none;" onclick="postComment();" class="btn"><i class="material-icons">send</i></button>
                    </div>
                    <div class="row" style="padding: 0px 5px 0px 5px;" >
                        <div class="col l1 m1 s2 center">
                            <img src="<?php echo $mUser->getImage(); ?>"class="responsive-img circle" style="border: 2px solid blue; margin-top: 5px; height:40px; width:40px; object-fit:cover; " alt="">
                        </div>
                        <div class="col s9 l10 m10" style="padding: 0px">
                            <div class="grey lighten-3" style="border-radius: 10px; padding: 10px;">
                                <b>Umair Farooqui</b><br><p style="margin-top: -8px">Umair Farooqui</p>
                                <div>
                                    <p style="margin-top: -15px; margin-bottom: -5px; ">asdfas asdfasd f asdfsadf sdf sdfasdfas asdfasd f asdfsadf sdf sdfasdfas asdfasd f asdfsadf sdf sdf</p>
                                </div>
                            </div>
                            <div style="margin-left: 10px;">
                                <Button class="left red-text" id="unlike$modelFeed->feedId" onClick="doUnlike(this.value)" value="unlike$modelFeed->feedId" style="padding: 5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;"><i class="material-icons prefix tiny">thumb_up</i> Like</Button>
                            </div>
                        </div>
                    </div>
                </div>
                <ul id='postMoreDropdown' class='dropdown-content'>
                    <li><a href="#!">Edit</a></li>
                    <li><a href="#!">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>


<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>