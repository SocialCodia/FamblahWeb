<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>

<?php

    $api = new Api;

    $responseUsers = $api->getUsers();
    if (!$responseUsers->error) 
    {
        $users = $responseUsers->users;
        $userArray = array();
        foreach ($users as $user) 
        {
            $card = <<<HERE
            <div class="col l2 m2 s6">  
            <div class="card hoverable " style="border-radius: 20px 20px 0px 0px; border-top: 10px solid blue; border-right: 1px solid blue; border-left: 1px solid blue;">
                <div class=""style="padding: 20px 20px 0px 20px;" >
                <img style=" border: 3px solid blue; width:160px; height:150px; object-fit:cover;" src="$user->image" alt="" class="z-depth-1 circle responsive-img">
                </div>
                <b><p class="center" style="margin-top: 0px;">$user->name</p></b>
                <p class="center" style="margin-top: -15px;"><a href="$user->username">@$user->username</a></p>
                <div class="card-saction center">
                <a href="$user->username" class="btn blue" style="width: 100%; ">Visit Profile</a>
                </div>
            </div>
            </div>
            HERE;;
            array_push($userArray, $card);
        }
    }

?>

    <div class="socialcodia">
        <div class="row">
            <h5>Users</h5>
            <?php
                if (!$responseUsers->error) 
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