<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>

<?php

    $api = new Api;

    $responseNotifications = $api->getNotifications();
    if (!$responseNotifications->error) 
    {
        // print_r($responseNotifications);
        $notifications = $responseNotifications->notifications;
        $userArray = array();
        foreach ($notifications as $notification) 
        {
            $card = <<<HERE
            <div class="col l6 m6 s12" id="divNotification$notification->notificationId">
                <ul class="collection">
                    <li class="collection-item avatar" style="padding-left: 90px;">
                        <a href="#">
                            <img src="$notification->userImage" alt="" width="" class="circle" style="width: 60px; height: 60px;">
                            <div style="margin-top: 9px;">
                                <span class="title">$notification->userName</span>
                                <p>$notification->notificationText</p>
                            </div>
                        </a>
                        <div style="margin-top: 14px;" class="secondary-content right">
                            <button id="btnDeleteNotification$notification->notificationId"  onclick="alertDeleteNotification(this.value)" value="$notification->notificationId" class="red btn" style="border: 1px solid white; border-radius: 90%;"><i class="material-icons white-text">delete</i></button>
                        </div>
                      </li>
                </ul>
            </div>
            HERE;
            array_push($userArray, $card);
        }
    }

?>

    <div class="socialcodia">
        <div class="row" style="margin-top: 20px;">
            <?php
                if (!$responseNotifications->error) 
                {
                    foreach ($userArray as $users) 
                    {
                        echo $users;
                    }
                }
            ?>
        </div>
    </div>


<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>