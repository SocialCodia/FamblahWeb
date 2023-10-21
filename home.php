    <?php require_once dirname(__FILE__).'/include/header.php'; ?>
    <?php require_once dirname(__FILE__).'/include/api.php'; ?>
    <?php require_once dirname(__FILE__).'/include/model/ModelUser.php'; ?>

    <?php
        $api = new Api;
        $feedsCard = $api->getFeeds();
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
        $verifiedHTML = '<i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>';
    ?>
    <?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
        <div class="socialcodia">

            <div class="row">
                <!-- *********************************Main Row offset 1 on both side, total row size is 10**************************************** -->
                <div class="col l12" style="padding:0px">

                    <!-- ***************************Left Side Row************************* -->
                    <div class="col l1"></div>
                    <!-- *****************************Middle Row For Post Content************************ -->
                    <div class="col l7 m12 s12">
                            <!-- ********************Add Feed Card Design***************** -->
                            <div class="card" style="border-radius: 10px">
                                <div class="row">
                                    <div class="col s12 l12 m12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="card-content" style="padding: 5px;">
                                                <div class="row" style="margin-bottom: 0px;">
                                                    <div class="col s3 m2 l2 center" style="margin-top: 10px;">
                                                        <a href="<?php echo $mUser->getUsername(); ?>">
                                                            <img src="<?php echo $mUser->getImage();?>"  width="55" class="responsive-img circle" style=" border: 2px solid blue; margin-top: 5px; width: 60px; height: 60px; object-fit: cover;" alt="">
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
                                foreach($feedsCard as $feed)
                                {
                                    echo $feed;
                                }
                            ?>
                    </div>

                    <!-- ****************************************Right Row*********************************** -->
                    <div class="col l4 m12 s12">
                        <div class="card z-depth-0">
                            <div class="card-header" style="padding: 20px;">
                                <b>Stories</b>
                                <i class="material-icons right">more_vert</i>
                            </div>
                            <div class="divider"></div>
                            <!-- **********************For User to add story*************************** -->
                            <!-- <div class="stories-row" style="padding: 10px;"> -->
                                <div class="row" style="margin: 0px; padding: 5px;">
                                    <div class="col s3 m3 l3 center">
                                        <img src="src/img/mufazmi.jpg" style="border: 2px solid red; min-width: 40px;" width="50" alt="" class="responsive-img circle">
                                    </div>
                                    <div class="col s9 m9 l16">
                                        <p style="font-weight: bold; margin-top: 6px;" onclick="createToast('asdfa','Demo Text','success','d','4000')">Add a new story</p>
                                        <p style="margin-top: -20px; font-size: small;">Yesterday at 9:32pm</p>
                                    </div>
                                </div>
                            <!-- </div> -->
                            <!-- **********************END For User to add story*************************** -->
                            <div class="divider"></div>
                            <!-- <div class="stories-row" style="padding: 10px;"> -->
                                <div class="row" style="margin: 0px; padding: 5px;">
                                    <div class="col s3 m3 l3 center">
                                        <img src="src/img/mufazmi.jpg" style="border: 2px solid red; min-width: 40px;" width="50" alt="" class="responsive-img circle">
                                    </div>
                                    <div class="col s9 m9 l16">
                                        <p onclick="createToast('asdfa','Demo Text','success','d','4000');" style="font-weight: bold; margin-top: 6px;">Add a new story</p>
                                        <p style="margin-top: -20px; font-size: small;">Yesterday at 9:32pm</p>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

    </script>
    <?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>

    <?php require_once dirname(__FILE__).'/include/footer.php'; ?>
