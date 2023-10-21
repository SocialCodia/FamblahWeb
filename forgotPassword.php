<?php require_once dirname(__FILE__).'/include/outer/header.php'; ?>

    <div class="row">
        <div class="col l6 offset-l3 m6 offset-m3 s12">
            <div class="card" style="border-radius: 20px; padding: 30px; margin-top: 80px;">
                <div class="row">
                    <div class="col l6 s12 center-align" style="padding: 30px;">
                        <img src="src/img/socialcodia logo.png" class="responsive-img" width="130" alt="">
                        <p style="font-weight: bold; margin-top: 40px; margin-bottom: 40px;">Social Ui helps you to connect and share with people in your life.</p>
                        <img src="src/img/otp_screen_image.png" style="width: 85%;" alt="" class="responsive-img">
                    </div>
                    <div class="col l6 s12" style="padding: 15px;">
                        <h5 style="font-weight: bold;">Forgot Password</h5>
                        <p class="grey-text" style=" margin-bottom: 30px;">Verify your account to get a new password.</p>
                        <p class="red-text center-align" style="font-weight: bold;" id="errorMessage"></p>
                        <div class="input-field" id="elemEmail">
                            <i class="material-icons prefix red-text">email</i>
                            <input type="email" name="inputEmail" id="inputEmail" class="validate">
                            <label for="inputEmail">Email Address</label>
                        </div>
                        <div class="input-field" id="elemOTP">
                            <i class="material-icons prefix red-text">lock_open</i>
                            <input type="number" name="inputOtp" id="inputOtp">
                            <label for="inputOtp">OTP</label>
                        </div>
                        <div class="input-field" id="elemNewPassword">
                            <i class="material-icons prefix red-text">lock</i>
                            <input type="password" name="inputNewPassword" id="inputNewPassword">
                            <label for="inputNewPassword">New Password</label>
                        </div>
                        <div class="input-field" id="elemBtnForgot">
                            <input class="btn red" style="border-radius: 20px; height: 50px; width:105px;" value="Send Otp" type="submit" onclick="forgotPassword()" name="btnForgot" id="btnForgot" >
                        </div>
                        <div class="input-field" id="elemBtnReset">
                                <input class="btn red" style="border-radius: 20px; height: 50px; width:150px;" value="Reset Password" onclick="resetPassword()" type="submit" name="btnReset" id="btnReset" >
                            </div>
                        <p class="center" style="margin-top:30px">Already have an account? <a href="login"><b>Login</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once dirname(__FILE__).'/include/outer/footer.php'; ?>