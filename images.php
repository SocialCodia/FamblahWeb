<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php require_once dirname(__FILE__).'/include/model/ModelVideo.php'; ?>


<?php
    if (isset($_GET['u'])) 
    {
        $username = $_GET['u'];
    }
    else
    {
        $username = $_SESSION['username'];
    }
    $api = new Api;
    $responseImages = $api->getImages($username);
    if (!$responseImages->error) 
    {
        $imageCard = array();
        $imageArary = $responseImages->Images;
        foreach ($imageArary as $imageList) 
        {
            $imageCardHTML = <<<HERE
            <div class="col s6 m3 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="$imageList->feedImage" class="responsive-img" alt="">
                    </div>
                </div>
            </div>
            HERE;;
            array_push($imageCard,$imageCardHTML);
        }
    }
    else
    {
        echo $responseImages->message;
    }
?>




    <div class="socialcodia">
        <div class="row">
            <?php
            if (!$responseImages->error) 
            {
                foreach ($imageCard as $image) 
                {
                    echo $image;
                }
            }
            ?>
        </div>
    </div>

<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>