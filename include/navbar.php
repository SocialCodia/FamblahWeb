<div class="navbar-fixed" style="">
    <nav class="white darken-1">
            <a href="home" class="brand-logo blue-text hide-on-med-and-down" style="margin-left:35px"><b>Famblah</b></a>
            <div class="row">
                <div class="col s1 m4 l3">
                    <ul class="left">
                        <li>     
                            <a href="#" class="sidenav-trigger" data-target="slide-out" style="margin:0px"><i class="material-icons black-text"><img src="src/icons/menu.png" width="25" alt=""></i></a>
                        </li>
                    </ul>
                </div>

                <div class="col s12 l5 hide-on-med-and-down">
                        <div class="input-field" >
                            <input class="blue lighten-5" style="border-radius: 30px; padding-left: 50px; height:40px; width:100%" type="text" name="search" id="search" placeholder="Search for Friends , Videos and more..">
                            <i class="material-icons blue-text prefix right" style="margin-top:-8px;">search</i>
                        </div>
                </div>
                
                <div class="col s11 m8 l4 hide-on-small-only">
                    <ul class="right">
                        <div class="row" style="margin-bottom:0px">
                            <div class="col s12 m12">
                                <div class="col s3 l2 m3">
                                    <li><a href="home"><i class="material-icons large tooltipped" data-position="bottom" data-tooltip="Home"><img src="src/icons/home.png" width="25" alt=""></i></a></li>
                                </div>
                                <div class="col s3 l2 m3">
                                    <li><a href="#"><i class="material-icons large tooltipped" data-position="bottom" data-tooltip="Message"><img src="src/icons/chaat.png" width="25" alt=""></i></a></li>
                                </div>
                                <div class="col s3 l2 m3">
                                    <li><a class="dropdown-trigger tooltipped" onclick="notificationSeened()" id="btnNotification" data-target="notificationDropdown" data-position="bottom" data-tooltip="Notification"><i class="material-icons large notif"><img src="src/icons/bell.svg" width="25" alt=""></i><small class="notification-badge" id="notificationBadge"></small></a></li>
                                </div>
                                <div class="col s3 l2 m3">
                                    <li><a href="" class="dropdown-trigger" data-target="profileMoreDropdown" data-tooltip="Profile"><i class="material-icons large "><img src="<?php  echo $mUser->getImage(); ?>" class="circle"  style=" border: 1px solid blue; width: 30px; height: 30px; object-fit: cover;" alt=""></i></a></li>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
    </nav>
  </div>
    <ul class="collection dropdown-content socialcodia-dropdown-content" id="profileMoreDropdown" style="width:300px">
        <li class="collection-item avatar">
            <a href="<?php echo $mUser->getUsername();?>">
            <img src="<?php echo $mUser->getImage();?>" style="object-fit: cover;" alt="" class="circle">
				<span class="title"><?php echo $mUser->getName();?></span>
				<p style="font-size:12px">See your profile</p>
            </a>
		</li>
        <li><a href="editProfile"><i class="material-icons"><img src="src/icons/home.png" width="25" alt=""></i> My Account</a></li>
        <li><a href="editProfile#password"><i class="material-icons">settings</i> Account Setting</a></li>
        <li><a href="logout"><i class="material-icons">power_settings_new</i> Logout</a></li>
    </ul>

    <ul class="collection dropdown-content socialcodia-dropdown-content" id="notificationDropdown" style="width:300px">

<?php



  $mResponseNotification = $api->getNotifications();

  if (!$mResponseNotification->error)
  {
    // print_r($mResponseNotification);
    $mNotification = $mResponseNotification->notifications;
    $notificationsCount = count($mNotification);
    $count =0;
    if ($notificationsCount<6)
    {
      $counts = $notificationsCount;
    }
    else
    {
      $counts = 6;
    }
    foreach ($mNotification as $notification) 
    {
      if ($count<$counts)
      {
             $notifcationHREF = "";
          if ($notification->notificationType == 1 || $notification->notificationType ==11 || $notification->notificationType ==111)
          {
              $notifcationHREF = "feed?feedId=$notification->feedId";
          }
          else
          {
              $notifcationHREF = $notification->userUsername;
          }

          $rowNotification =  
          <<<HERE
          <a class="collection-item avatar" href="$notifcationHREF" style="min-height: unset;">
              <img src="$notification->userImage" alt="" class="circle">
              <p><b>$notification->userName</b> $notification->timestamp </p> 
              <p>$notification->notificationText</p>
          </a> 
          HERE;; 
        echo $rowNotification;
        $count++;
      }

    }
  }


?>
        <li><a href="notifications"><i class="material-icons">expand_more</i>    More</a></li>
    </ul>
    
