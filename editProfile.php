<?php require_once dirname(__FILE__).'/include/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php require_once dirname(__FILE__).'/include/navbar.php'; ?>
<?php require_once dirname(__FILE__).'/include/functions.php'; ?>

<?php
    $api = new Api;
    $functions = new Functions;
    $error = false;
    $message = "";

    if (isset($_POST['changePassword'])) 
    {
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($functions->haveEmptyParameter($password))
        {
            $error = true;
            $message = "Empty Password";
        }
        else if ($functions->checkLength($password,8,20))
        {
            $error = true;
            $message = "Wrong Password";
        }
        else if ($functions->haveEmptyParameter($newPassword))
        {
            $error = true;
            $message = "Empty New Password";
        }
        else if ($functions->checkLength($newPassword,8,20))
        {
            $error = true;
            $message = "Password should be greater than 7 charectar";
        }
        else if ($functions->haveEmptyParameter($confirmPassword))
        {
            $error = true;
            $message = "Empty Confirm Password";
        }
        else if ($functions->checkLength($confirmPassword,8,20))
        {
            $error = true;
            $message = "Password should be greater than 7 charectar";
        }
        else if (strcmp($newPassword, $confirmPassword)) 
        {
            $error = true;
            $message = "Password Not Matched";
        }
        else if ($newPassword&&$confirmPassword==$password) 
        {
            $error = true;
            $message = "Your Old And New Password Is Same";
        }
        else
        {
            $responsePassword = $api->doChangePassword($password,$newPassword);
            $error = true;
            $message = $responsePassword->message;
        }

    }

    if (isset($_POST['updateProfile'])) 
    {
        $name = $_POST['name'];
        $mUsername = $_POST['username'];
        $image = $_FILES['image'];
        $bio = $_POST['bio'];
        if ($functions->haveEmptyParameter($name))
        {
            $error = true;
            $message = "Empty Name";
        }
        else if ($functions->checkLength($name,3,30))
        {
            $error = true;
            $message = "Name could not be less than 3 charectar";
        }
        else if ($functions->haveEmptyParameter($mUsername))
        {
            $error = true;
            $message = "Empty Username";
        }
        else if ($functions->checkLength($mUsername,3,15))
        {
            $error = true;
            $message = "Username could not be less than 3 charectar";
        }
        else
        {
            $responsProfileUpdate = $api->doUpdateUser($name,$mUsername,$image,$bio);
            $error = true;
            $message = $responsProfileUpdate->message;
        }

    }

?>


    <div class="socialcodia">
    <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="col s12 m10 l10 offset-m1 offset-l1">
                        <ul class="tabs">
                            <li class="tab col s6 m6 l6"><a href="#profile"><b>Profile Information</b></a></li>
                            <li class="tab col s6 m6 l6"><a href="#password"><b>Change Password</b></a></li>
                        </ul>
                    </div>
                </div>
                <div id="profile" class="col s12">
                    <div class="card">
                        <h5 style="padding: 15px;">Profile Information</h5>
                        <div class="divider"></div>
                        <div class="container" style="padding: 30px 0px 30px 10px;">
                        <p class="red-text center-align"><b><?php if(isset($error) && $error==1 || isset($error) && $error==true) { echo $message; } ?></b></p>
                            <form action="" method="post" enctype="multipart/form-data">
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
                            </form>
                        </div>
                    </div>
                </div>
                <div id="password" class="col s12">
                    <div class="card">
                        <h5 style="padding: 15px;">Change Password</h5>
                        <div class="divider"></div>
                        <div class="container" style="padding: 30px 0px 30px 10px;">
                            <p class="red-text center-align"><b><?php if(isset($error) && $error==1 || isset($error) && $error==0) { echo $message; } ?></b></p>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col s12 m12 l12">
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
                                            <input type="submit" class="btn blue" name="changePassword" id="changePassword" value="Change Password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once dirname(__FILE__).'/include/sidenav.php'; ?>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>