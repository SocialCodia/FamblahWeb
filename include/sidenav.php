<ul id="slide-out" class="sidenav collapsible sidenav-fixed z-depth-0" style=" top:55px; font-weight:bold;">
        <li class="hide-on-large-only">
                <div class="user-view">
                      <div class="background">
                        <img src="img/bg.jpg" style="background-size: cover;">
                      </div>
                      <a href="<?php echo $mUser->username; ?>"><img class="circle" src="<?php echo $mUser->image; ?>"></a>
                      <a href="#!"><span class="white-text name"><?php echo $mUser->name; ?></span></a>
                      <a href="#!"><span class="white-text email"><?php echo $mUser->email; ?></span></a>
                </div>
        </li>
        <li class="hide-on-med-and-down"><a href="<?php echo $mUser->username?>"><i class="material-icons"><img src="<?php echo $mUser->image?>" width="25" class="circle" alt=""></i> Profile</a></li>
        <li><a href="home"><i class="material-icons"><img src="src/icons/home.png" width="25" alt=""></i> Feed</a></li>
        <li><a href="friends"><i class="material-icons"><img src="src/icons/friends.png" width="25" alt=""></i> Friends</a></li>
        <li><a href="images"><i class="material-icons"><img src="src/icons/photo.png" width="25" alt=""></i> Gallery</a></li>
        <li><a href="videos"><i class="material-icons"><img src="src/icons/video.png" width="25" alt=""></i> Video</a></li>
        <li><a href="users"><i class="material-icons"><img src="src/icons/group.png" width="25" alt=""></i> Users</a></li>
        <div class="divider"></div>
        <li><a href="logout"><i class="material-icons">power_settings_new</i>Logout</a></li>
        <li><a href="about"><i class="material-icons"><img src="src/icons/info.png" width="25" alt=""></i>About Us</a></li>
        <li><a href="contact"><i class="material-icons"><img src="src/icons/contact_us.png" width="25" alt=""></i>Contact Us</a></li>
</ul>