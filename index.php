<?php require_once dirname(__FILE__).'/include/outer/header.php'; ?>
<?php require_once dirname(__FILE__).'/include/api.php'; ?>

<?php
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $api = new Api();
        $loginResponse = $api->doLogin($email,$password);
        if(!$loginResponse->error)
        {
            $user = new ModelUser($loginResponse->user);
            $token = $loginResponse->user->token;
            setcookie("token",$token);
            $_SESSION['id'] = $user->getId();
            $_SESSION['name'] = $user->getName();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['image'] = $user->getImage();
            header("LOCATION:home");
        }
        else
        {
            $error = true;
            $message = $loginResponse->message;
        }
    }
?>
    <div class="row">
        <div class="col l6 offset-l3 m6 offset-m3 s12">
            <div class="card" style="border-radius: 20px; padding: 30px; margin-top: 120px; ">
                <div class="row">
                    <div class="col l6 s12 center-align" style="padding: 30px;">
                        <img src="src/img/socialcodia logo.png" class="responsive-img" width="130" alt="">
                        <p style="font-weight: bold; margin-top: 40px; margin-bottom: 40px;">FAMBLAH helps you to connect and share with people in your life.</p>
                        <img src="src/icons/group_c.svg" style="width: 85%;" alt="" class="responsive-img hide-on-med-and-down">
                    </div>
                    <div class="col l6 s12" style="padding: 15px; ">
                        <h5 style="font-weight: bold;">Login</h5>
                        <p class="grey-text" style=" margin-bottom: 30px;">Login into your account to continue...</p>
                        <p class="red-text center-align"><b><?php if(isset($error) && $error==1 || isset($error) && $error==0) { echo $message; } ?></b></p>
                        <form action="" method="post">
                            <div class="input-field">
                                <i class="material-icons prefix red-text">email</i>
                                <input type="text"  name="email" id="email">
                                <label for="email">Email or Username</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix red-text">lock</i>
                                <input type="password" name="password" id="password">
                                <label for="password">Password</label>
                            </div>
                            <p class="right-align" style="margin-top: -13px;"><a href="forgotPassword">Forgot Password?</a></p>
                            <div class="input-field">
                                <input class="btn red" style="border-radius: 20px; height: 50px; width:105px;" value="Login" type="submit" name="login" id="login" >
                            </div>
                        </form>
                        <p class="center" style="margin-top:30px">Don't have an account? <a href="register"><b>Register</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once dirname(__FILE__).'/include/outer/footer.php'; ?>
