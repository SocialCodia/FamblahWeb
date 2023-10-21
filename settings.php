<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>


    <div class="socialcodia">
        <div class="row">
        	<div class="col l12 s12">
        		<ul class="collapsible ">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">person</i>Edit Profile</div>
                      <div class="collapsible-body">
                      	<div class="row">
                            <div class="col s12 center">
                                <input id="image" type="file" onchange="previewProfileImage(this);" name="image" class="hide"/>
                                <label for="image"><img src="<?php echo $mUser->getImage(); ?>" style="height: 160px; width: 160px; object-fit: cover; border: 2px solid blue;" id="userProfileImage" class="responsive-img circle" width="110" alt=""></label>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="input-field">
                                        <input type="text" name="name" id="name" value="<?php echo $mUser->getName(); ?>">
                                        <label for="name blue-text">Enter Name</label>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" name="username" id="username" value="<?php echo $mUser->getUsername(); ?>">
                                        <label for="name">Enter Username</label>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" name="email" id="email" value="<?php echo $mUser->getEmail(); ?>">
                                        <label for="email">Enter Email</label>
                                    </div>
                                    <div class="input-field">
                                        <textarea name="bio" id="bio" cols="30" rows="10" maxlength="1000" style="max-height: 250px; min-height: 90px;" class="materialize-textarea" placeholder="Bio"><?php echo $mUser->getBio(); ?></textarea>
                                    </div>
                                    <div class="input-field center">
                                        <input type="submit" class="btn blue" name="updateProfile" id="updateProfile" value="Update Profile">
                                    </div>
                                </div>
                            </div>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">lock</i>Change Password</div>
                      <div class="collapsible-body">
                      		<div class="row">
                                <div class="input-field">
                                    <input type="password" name="password" id="password" required="required">
                                    <label for="password">Enter Current Password</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" name="newPassword" id="newPassword" required="required">
                                    <label for="newPassword">Enter New Password</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" name="confirmPassword" id="confirmPassword" required="required">
                                    <label for="confirmPassword">Enter Confirm Password</label>
                                </div>
                                <div class="input-field center">
                                    <button class="btn blue" name="btnChangePassword" id="btnChangePassword" onclick="changePassword()">Change Password</button>
                                </div>
                            </div>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                    </li>
                </ul>
        	</div>
        </div>
    </div>


<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>