<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="css/icons.css" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="css/materialize.min.css">
        <link rel="stylesheet" href="css/socialcodia.css">
        <link rel="stylesheet" href="css/toast.css">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="icon" href="src/img/icon_.png" type="image/gif" sizes="16x16">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>  
  <?php 
  require_once dirname(__FILE__).'/api.php';
  require_once dirname(__FILE__).'/model/ModelUser.php';
    $api = new Api;
    $mResponseUser = $api->getUser();
    try {
        if (!$mResponseUser->error) {
          $mUser = new ModelUser($mResponseUser->user);
          $mUserImage = $mUser->getImage();
        }
        else
        {
            $mUser = new ModelUser;
            $mUser->setName('');
            $mUser->setUsername('');
            $mUser->setImage('http://socialcodia.net/SocialApiFriendsSystem/public/uploads/api/user.png');
            $mUser->setBio('');
        }
    } catch (Exception $e) {
      echo $e;
    }
  ?>

<?php
session_start();

if(!isset($_SESSION['id']))
{
    header("LOCATION:login");

}
?>
<style>
        header, .socialcodia, footer {
        padding-left: 300px;
        padding-right:1px;
      }
  
      @media only screen and (max-width : 992px) {
        header, .socialcodia, footer {
          padding-left: 0;
        }
      }
      textarea:focus {
        border-bottom: none!important;
        box-shadow: none!important;
      }
      .notification-badge {
        position: relative;
        right: 5px;
        top: -20px;
        color: white;
        font-weight: bold;
        background-color: red;
        /*margin: 0 -.8em 10px 20px;*/
        border-radius: 50%;
        padding: 3px 7px ;
    }
    .notif{
  position: absolute;
}
.footer-fixed {
  position: fixed;
  bottom: 0;
  width: 100%;
}
</style>

<body class="" style="font-family: Rajdhani,sans-serif; background-color: #f5f5f7; word-break: break-all;">