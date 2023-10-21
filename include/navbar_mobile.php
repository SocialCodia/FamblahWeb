<div class="navbar-fixed" style="z-index:9999;">
    <nav class="white darken-1">
      <div class="row">
        <ul>
              <div class="col s3 l2 m3">
                  <li><a href="home"><i class="material-icons large tooltipped" data-position="top" data-tooltip="Home"><img src="src/icons/home.png" width="25" alt=""></i></a></li>
              </div>
              <div class="col s3 l2 m3">
                  <li><a href="users"><i class="material-icons large tooltipped" data-position="top" data-tooltip="Users"><img src="src/icons/group.png" width="25" alt=""></i></a></li>
              </div>
              <div class="col s3 l2 m3">
                  <li><a href="notifications" class="tooltipped" onclick="notificationSeened()" id="btnNotification" data-position="top" data-tooltip="Notification"><i class="material-icons large notif"><img src="src/icons/bell.svg" width="25" alt=""></i><small class="notification-badge" id="notificationBadgeMobile"></small></a></li>
              </div>
              <div class="col s3 l2 m3">
                  <li><a href="<?php  echo $mUser->getUsername(); ?>" data-position="top" data-tooltip="Notification"><i class="material-icons large notif"><img src="<?php  echo $mUser->getImage(); ?>" class="circle" width="25" alt=""></i></small></a></li>
              </div>
        </ul>
      </div>
    </nav>
  </div>