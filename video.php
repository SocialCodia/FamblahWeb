<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php require_once dirname(__FILE__).'/include/model/ModelVideo.php'; ?>

<?php
    if (isset($_GET['v']) && !empty($_GET['v'])) 
    {
        $videoId = $_GET['v'];
    }
    else
    {
        header("LOCATION:videos.php");
    }
    $api = new Api;
    $responseVideo = $api->getVideo($videoId);
    if (!$responseVideo->error) 
    {
        $video = new ModelVideo($responseVideo->video);
    }
    else
    {
       $video = new ModelVideo();
    //    $video->setVideoUrl(VIDEO_NOT_FOUND_IMAGE);
       $video->setTimestamp("No Found");
       $video->setVideoTitle("Video Not Found..!");
       $video->setVideoImage(VIDEO_NOT_FOUND_IMAGE);
       $video->setUserImage(USER_NOT_FOUND_IMAGE);
       $video->setUserName("Video Not Found");

    }
    $videoHtml = <<<HERE
    <div class="col l9 m12 s12">
    <video class="responsive-video" style="width:100%" poster="{$video->getVideoImage()}" autoplay="autoplay" loop controls>
        <source src="{$video->getVideoUrl()}" type="video/mp4">
    </video>
    <div class="" style="padding: 5px;">
        <h5 style="text-transform: uppercase;">{$video->getVideoTitle()}</h5>
        <p>299 Views .{$video->getTimestamp()}</p>
        <div class="card blue lighten-5 z-depth-0">
            <div class="row">
                <div class="col l6 m6 s12">
                    <div class="col l4 m3 s4">
                        <p>
                            <img src="{$video->getUserImage()}" alt="" width="" class="circle" style="width: 55px; height: 55px;">
                        </p>
                    </div>
                    <div class="col l8 m9 s8">
                        <h5>{$video->getUserName()}</h5>
                    </div>
                </div>
                <div class="col l6 m6 s12">
                    <div class="col l6 m6 s6">
                        <p style="font-weight: bold; font-size: 22px;">Share on</p>
                    </div>
                    <div class="col l2 m2 s2 center">
                        <h5>
                            <a href="">
                                <p>
                                    <img src="src/icons/facebook_black.png" width="30" alt="">
                                </p>
                            </a>
                        </h5>
                    </div>
                    <div class="col l2 m2 s2 center">
                        <h5>
                            <a href="">
                                <p>
                                    <img src="src/icons/twitter_black.png" width="30" alt="">
                                </p>
                            </a>
                        </h5>
                    </div>
                    <div class="col l2 m2 s2 center">
                        <h5>
                            <a href="">
                                <p>
                                    <img src="src/icons/share_black.png" width="30" alt="">
                                </p>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <h5 style="font-weight: bold;">Description</h5>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro laudantium ad officia vitae facere, nisi quis obcaecati accusantium illum, hic similique fuga cupiditate adipisci maxime, odit rem doloremque esse? Commodi iste, nisi eius maiores omnis autem quia corporis enim numquam cupiditate et consectetur vero repudiandae cum quae magni voluptatum vitae! Laboriosam dolorem sunt labore, quam molestias nam omnis, animi, at doloremque ducimus pariatur possimus nemo enim placeat! Consectetur architecto asperiores aliquam possimus debitis quis rem sapiente eaque numquam quaerat voluptas sed maxime ad culpa dolor repudiandae iusto sequi, quidem cumque nemo voluptates suscipit itaque illo. Ducimus itaque facere tempore maxime.</p>
        <div class="divider"></div>
    </div></div>
    HERE;;
?>

<?php
    $reponseVideos = $api->getVideos();
    if (!$reponseVideos->error) 
    {
        $videos = $reponseVideos->videos;
        $videosCard = array();
        foreach($videos as $videoList)
        {
            $videoRightHtml = <<<HERE
            <div class="col l3 m12 s12">
            <a href="watch?v=$videoList->videoId">
                <div class="card z-depth-0">
                    <div class="card-image ">
                        <img src="$videoList->videoImage" height="180" alt="">
                    </div>
                    <p class="black-text"><b>$videoList->videoTitle</b></p>
                </div>
            </a></div>
            HERE;;
            array_push($videosCard, $videoRightHtml);
        }
    }
?>

<div class="socialcodia">
        <div class="row" style="margin-top:10px;">
            <!-- ***************************Left Side Row************************* -->
            <?php
            echo $videoHtml;
            ?>
            <?php
                foreach($videosCard as $videos)
                {
                    echo $videos;
                }
            ?>
        </div>
    </div>



<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>