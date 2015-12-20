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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DreamNet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
    <h1 class="heading-primary">Make dreams come true</h1>
    <div class="accordion">
        <dl>

            <?php

            $upcoming_dreams = $connection->server->query("SELECT a.user_displayname, b.dream_title, b.dream_text, b.mih_count, b.status FROM users a, dreams b WHERE a.id = b.user_id AND b.status = 'upcoming'");
            $number_of_rows = $upcoming_dreams->num_rows;

            for($i = 0; $i < $number_of_rows; $i++){

                $row = $upcoming_dreams->fetch_row();
                echo "<dt><a href='#accordion1' aria-expanded='false' aria-controls='accordion1' class='accordion-title accordionTitle js-accordionTrigger' style='display: flex; flex-direction: row;'><b style='flex-grow: 1;'>$row[0]</b><b style='flex-grow: 1'>$row[1]</b><b style='flex-grow: 1'>Supporters: $row[3]</b></a></dt>";
                echo "<dd class='accordion-content accordionItem is-collapsed' id='accordion1' aria-hidden='true'>$row[2]</dd>";
            }

            ?>

        </dl>
    </div>
    <script src="JS/js.js"></script>
</div>
</body>
</html>
