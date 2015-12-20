<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12/20/2015
 * Time: 1:21 AM
 */
date_default_timezone_set('Asia/Tbilisi');
require_once 'Classes/login.php';
require_once 'Classes/user.php';
$connection = new server('localhost', 'root', 'root', 'dreamnet');
$user = new user();
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$registration_error = '';
$active = "";
$error = "";
session_start();


if(isset($_POST['log_out'])){

    $user->userLogout();
    header("Location: $link");

}

if(isset($_POST['sign_in'])){

    $user->userLogin($_POST['email'], $_POST['password']);

    if(!isset($_SESSION['id'])){ $active = 'open'; $error = '<b style="color: darkred">Incorrect E-mail or Password</b>'; }

}


if(isset($_POST['register'])){

    $name = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $displayname  = $_POST['display_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirmation'];

    if($password == $confirm_password){ $registration_error = $user->userRegistration($name, $lastname, $displayname, $email, $password); }
    if($registration_error == ''){ $user->userLogin($email, $password); header("Location: http://localhost/dreamnet/"); }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DreamNet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="JS/main.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost/dreamnet/">DreamNet</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/dreamnet/dream.php">Add Your Dream</a></li>
                <li><a href="http://localhost/dreamnet/top_dreams.php">Top Dreams</a></li>
                <li class="active"><a href="http://localhost/dreamnet/index.php">Upcoming Dreams</a></li>
                <li><a href="http://localhost/dreamnet/achieved_dreams.php">Achieved Dreams</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php

                if(isset($_SESSION['id'])){

                    $id = $_SESSION['id'];
                    $user_displayname = $connection->server->query("SELECT user_displayname FROM users WHERE id = '$id'")->fetch_row();
                    echo<<<_END
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>$user_displayname[0]</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                    <div class="col-md-12">
                                    <form class='form' role='form' method='post' action='$link' accept-charset='UTF-8' id='login-nav'>
                                        <div class="form-group"><button type="submit" name="log_out" class="btn btn-primary btn-block">Log out</button></div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
_END;
                }
                else{

                    echo<<<_END

                <li><a href="http://localhost/dreamnet/registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li class="dropdown $active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                    <div class="col-md-12">
                                    $error
                                    <form class='form' role='form' method='post' action='$link' accept-charset='UTF-8' id='login-nav'>
                                        <div class="form-group">
                                            <label class="sr-only">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                        </div>
                                        <div class="form-group"><button type="submit" name="sign_in" class="btn btn-primary btn-block">Sign in</button></div>
                                        <div class="checkbox"><label><input type="checkbox"> keep me logged-in</label></div>
                                    </form>
                                </div>

                            </div>
                        </li>
                    </ul>
                </li>
_END;
                }

                ?>

            </ul>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <?php
            echo "<form role='form' method='post' action='$link'>";
            ?>

                <h2>Please Sign Up</h2>
                <hr class="colorgraph">
            <?php

            if($registration_error != ""){

                echo "<div class='form-group'><input type='text' name='error'  class='form-control input-lg' tabindex='3' value='$error' style='color: #F0776C'></div>";
            }


            ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Display Name" tabindex="3">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                        </div>
                    </div>
                </div>


                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-12"><input type="submit" value="Register" name="register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>




