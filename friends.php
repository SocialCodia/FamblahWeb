<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
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
    $reponseFriends = $api->getFriends($username);
    if (!$reponseFriends->error) 
    {
        $friends = $reponseFriends->friends;
        $friendsCard = array();
        foreach($friends as $friendList)
        {
            $friendHtml = <<<HERE
            <div class="col l4 m6 s12">
            <a href="$friendList->username"><ul class="collection">
            <li class="collection-item avatar" style="padding-left: 90px;">
                <img src="$friendList->image" alt="" width="" class="circle" style="width: 60px; height: 60px;">
                <p class="title black-text" style="margin-top:6px;"><b>$friendList->name</b></p>
                <p>@$friendList->username</p>
                <a href="#!" class="secondary-content"><i class="material-icons">more_vert</i></a>
              </li></ul></a></div>
            HERE;;
            array_push($friendsCard, $friendHtml);
        }
    }
    else
    {

    }
?>

<div class="socialcodia">
        <div class="row">
            <!-- *********************************Main Row offset 1 on both side, total row size is 10**************************************** -->
            <div class="col l12 m12 s12" style="padding:0px">

                <!-- ***************************Left Side Row************************* -->
                <div class="col s12 l12 m12">
                        <h5>Your Friends</h5>
                        <?php
                            if (!$reponseFriends->error)
                            {
                                foreach($friendsCard as $friends)
                                {
                                    echo $friends;
                                }
                            }
                            else
                            {
                                echo '<h5 align="center">No Friends</h5>';
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>



<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>