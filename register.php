<?php require_once dirname(__FILE__).'/include/outer/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>
<?php

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $api = new Api;
    $registerResponse = $api->doRegister($name,$username,$email,$password);
    if(!$registerResponse->error)
    {
        $error = false;
        $message = $registerResponse->message;
    }
    else
    {
        $error = true;
        $message = $registerResponse->message;
    }
}

?>
    <div class="row">
        <div class="col l6 offset-l3 m6 offset-m3 s12">
            <div class="card" style="border-radius: 20px; padding: 30px 30px 10px 30px ; margin-top: 40px;">
                <div class="row" style="margin-bottom: 0px;">
                    <div class="col l6 s12 center-align" style="padding: 30px;">
                        <img src="src/img/socialcodia logo.png" class="responsive-img" width="130" alt="">
                        <p style="font-weight: bold; margin-top: 40px; margin-bottom: 40px;">Social Ui helps you to connect and share with people in your life.</p>
                        <img src="src/img/otp_screen_image.png" style="width: 85%;" alt="" class="responsive-img">
                    </div>
                    <div class="col l6 s12" style="padding: 15px;">
                        <h5 style="font-weight: bold;">Register</h5>
                        <p class="grey-text" style=" margin-bottom: 30px;">It's free and always will be.</p>
                        <p class="red-text center-align" style="font-weight: bold;" id="errorMessage"></p>
                        <!-- <form action="" method="post"> -->
                            <div class="input-field">
                                <i class="material-icons prefix red-text">person</i>
                                <input type="text" name="inputName" value="Demo Demo" id="inputName">
                                <label for="inputName">Name</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix red-text">email</i>
                                <input type="email" name="inputEmail" value="demodemo@demodemo.demo" id="inputEmail" class="validate">
                                <label for="inputEmail">Email Address</label>
                                <span class="helper-text red-text" id="helperEmail" data-error="Invalid Email Address"></span>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix red-text">lock</i>
                                <input type="password" name="inputPassword" value="farooqui" id="inputPassword">
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="input-field">
                                <input class="btn red" style="border-radius: 20px; height: 50px; width:105px;" value="Register" type="submit" name="register" id="btnRegister" onclick="register()" id="register" >
                            </div>
                        <!-- </form> -->
                        <p class="center" style="margin-top:30px">Already have an account? <a href="login"><b>Login</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once dirname(__FILE__).'/include/outer/footer.php'; ?>