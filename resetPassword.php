<?php require_once dirname(__FILE__).'/include/outer/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php
    if(!isset($_SESSION['resetEmail']))
    {
        header("LOCATION:forgotPassword");
    }

    if(isset($_POST['resetPassword']))
    {
        $api = new Api;
        $email = $_SESSION['resetEmail'];
        $otp = $_POST['otp'];
        $newPassword = $_POST['newPassword'];
        $responseResetPassword = $api->doResetPassword($email,$otp,$newPassword);
        if(!$responseResetPassword->error)
        {
            $error = false;
            $message = $responseResetPassword->message;
        }
        else
        {
            $error = true;
            $message = $responseResetPassword->message;
        }
    }

?>
    <div class="row">
        <div class="col l6 offset-l3 m6 offset-m3 s12">
            <div class="card" style="border-radius: 20px; padding: 30px; margin-top: 70px;">
                <div class="row">
                    <div class="col l6 s12 center-align" style="padding: 30px;">
                        <img src="src/img/socialcodia logo.png" class="responsive-img" width="130" alt="">
                        <p style="font-weight: bold; margin-top: 40px; margin-bottom: 40px;">Social Ui helps you to connect and share with people in your life.</p>
                        <img src="src/img/otp_screen_image.png" style="width: 85%;" alt="" class="responsive-img">
                    </div>
                    <div class="col l6 s12" style="padding: 15px;">
                        <h5 style="font-weight: bold;">Reset Password</h5>
                        <p class="grey-text" style=" margin-bottom: 30px;">Enter Otp to get a new Password.</p>
                        <p class="red-text center-align"><b><?php if(isset($error) && $error==1 || isset($error) && $error==0) { echo $message; } ?></b></p>
                        <form action="" method="post">
                            <div class="input-field">
                                <i class="material-icons prefix red-text">email</i>
                                <input type="email" value="<?php echo $_SESSION['resetEmail']; ?>" name="email" id="email" readonly>
                                <label for="name">Email Address</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix red-text">lock_open</i>
                                <input type="number" name="otp" id="otp">
                                <label for="otp">OTP</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix red-text">lock</i>
                                <input type="password" name="newPassword" id="newPassword">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                <input class="btn red" style="border-radius: 20px; height: 50px; width:150px;" value="Reset Password" type="submit" name="resetPassword" id="resetPassword" >
                            </div>
                        </form>
                        <p class="center" style="margin-top:30px">Already have an account? <a href="login"><b>Login</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once dirname(__FILE__).'/include/footer.php'; ?>