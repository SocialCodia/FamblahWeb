<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php
    $api = new Api;
    $reponseVideos = $api->getVideos();
    if (!$reponseVideos->error) 
    {
        $videos = $reponseVideos->videos;
        $videosCard = array();
        foreach($videos as $videoList)
        {
            $videoHtml = <<<HERE
            <div class="col l3 m4 s12">
            <a href="watch?v=$videoList->videoId">
                <div class="card z-depth-0">
                    <div class="card-image ">
                        <img src="$videoList->videoImage" height="180" alt="">
                    </div>
                    <p class="black-text"><b>$videoList->videoTitle</b></p>
                </div>
            </a></div>
            HERE;;
            array_push($videosCard, $videoHtml);
        }
    }
?>
<div class="socialcodia">
        <div class="row">
            <!-- *********************************Main Row offset 1 on both side, total row size is 10**************************************** -->
            <div class="col l12 m12 s12" style="padding:0px">

                <!-- ***************************Left Side Row************************* -->
                <div class="col s12 l12 m12">
                        <h5>Browse Videos</h5>
                        <?php
                            foreach($videosCard as $videos)
                            {
                                echo $videos;
                            }
                        ?>
                </div>
            </div>
        </div>
</div>



<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>