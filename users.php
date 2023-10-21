<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>

<?php

    $verifiedHTML = '<i style="cursor:pointer;" data-position="right" data-tooltip="Verified Account" class="material-icons tooltipped tiny blue-text">check_circle</i>';
?>

<?php

    $api = new Api;

    $responseUsers = $api->getUsers();
    if (!$responseUsers->error) 
    {
        // print_r($responseUsers);
        $users = $responseUsers->users;
        $userArray = array();
        foreach ($users as $user) 
        {
            $btnAddFriendHTML = <<<HERE
            <button id="btnAddFriend$user->id" onclick="sendFriendRequest(this.value)" value="$user->id" class="blue btn" style="border: 1px solid white; border-radius: 100%;
            HERE;
            if ($user->friendshipStatus!=1 && $user->friendshipStatus!=2 && $user->friendshipStatus!=3)
                $btnAddFriendHTML .= 'display:revert';
            else
                $btnAddFriendHTML .= 'display:none';

            $btnAddFriendHTML .= <<<HERE
            "><i class="material-icons white-text">add</i></button>
            HERE;

            $btnUnfriendHTML = <<<HERE
            <button id="btnUnfriend$user->id" onclick="alertDeleteFriend(this.value)" value="$user->id" class="red btn" style="border: 1px solid white; border-radius: 90%;
            HERE;

            if ($user->friendshipStatus==1)
                $btnUnfriendHTML .= 'display:revert';
            else
                $btnUnfriendHTML .= 'display:none';
            $btnUnfriendHTML .= <<<HERE
            "><i class="material-icons white-text">delete</i></button>
            HERE;

            $btnAcceptFriendRequestHTML = <<<HERE
            <button id="btnAcceptFriendRequest$user->id" onclick="acceptFriendRequest(this.value)" value="$user->id" class="blue btn" style="border: 1px solid white; border-radius: 90%;
            HERE;

            if ($user->friendshipStatus==3)
                $btnAcceptFriendRequestHTML .= 'display:revert';
            else
                $btnAcceptFriendRequestHTML .= 'display:none';
            $btnAcceptFriendRequestHTML .= <<<HERE
            "><i class="material-icons white-text">check</i></button>
            HERE;

            $btnCancelFriendRequestHTML = <<<HERE
            <button id="btnCancelFriendRequest$user->id" onclick="alertCancelFriendRequest(this.value)" value="$user->id" class="red btn" style="border: 1px solid white; border-radius: 90%; 
            HERE;

            if ($user->friendshipStatus==2)
                $btnCancelFriendRequestHTML .= 'display:revert';
            else
                $btnCancelFriendRequestHTML .= 'display:none';

            $btnCancelFriendRequestHTML .= <<<HERE
            "><i class="material-icons white-text">cancel</i></button>
            HERE;

            $btnBlockFriendHTML = <<<HERE
            <button id="btnBlockFriend$user->id" onclick="alertBlockFriend(this.value)" value="$user->id" class="red btn" style="border: 1px solid white; border-radius: 90%; display:none; visibility:hidden;"><i class="material-icons white-text">cancel</i></button>
            HERE;

            $btnUnBlockFriendHTML = <<<HERE
            <button id="btnUnBlockFriend$user->id" onclick="alertUnBlockFriend(this.value)" value="$user->id" class="red btn" style="border: 1px solid white; border-radius: 90%; display:none; visibility:hidden; "><i class="material-icons white-text">cancel</i></button>
            HERE;

            $btnRejectFriendRequestHTML = <<<HERE
            <button id="btnRejectFriendRequest$user->id"  onclick="alertRejectFriendRequest(this.value)" value="$user->id" class="red btn" style="border: 1px solid white; border-radius: 90%;
            HERE;

            if ($user->friendshipStatus==3)
                $btnRejectFriendRequestHTML .= 'display:revert';
            else
                $btnRejectFriendRequestHTML .= 'display:none';
            $btnRejectFriendRequestHTML .= <<<HERE
            "><i class="material-icons white-text">cancel</i></button>
            HERE;
            $card = <<<HERE
            <div class="col l4 m6 s12" style="margin-top:-15px; paddin:px;">
                <ul class="collection">
                    <li class="collection-item avatar" style="padding-left: 90px;">
                        <a href="$user->username">
                            <img src="$user->image" alt="" width="" class="circle" style="width: 60px; height: 60px;">
                            <div style="margin-top: 9px;">
                                <span class="title">$user->name</span>
            HERE;

            if ($user->status==1)
            {
                $card .= " ".$verifiedHTML;
            }

            $card .= <<<HERE
                                <p>$user->username</p>
                            </div>
                        </a>
                        <div style="margin-top: 14px;" class="secondary-content right">
            HERE;
                            $card .= <<<HERE
                            $btnAddFriendHTML
                            HERE;

                            $card .= <<<HERE
                            $btnUnfriendHTML
                            HERE;

                            $card .= <<<HERE
                            $btnAcceptFriendRequestHTML
                            HERE;

                            $card .= <<<HERE
                            $btnCancelFriendRequestHTML
                            HERE;
                            
                            $card .= <<<HERE
                            $btnRejectFriendRequestHTML
                            HERE;

                            $card .= <<<HERE
                            $btnBlockFriendHTML
                            HERE;

                            $card .= <<<HERE
                            $btnUnBlockFriendHTML
                            HERE;

            $card .= <<<HERE
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