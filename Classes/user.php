<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 10/20/2015
 * Time: 3:09 PM
 */

require_once 'login.php';


class user extends server{

    protected $id;
    protected $user_name;
    protected $user_lastname;
    protected $display_name;
    protected $email;
    protected $password;
    public $session_id;



    public function __construct(){

        parent::__construct('localhost', 'root', 'root', 'dreamnet');

    }


    public function userRegistration($user_name, $user_lastname, $display_name, $email, $password){


        if(is_string($user_name)){

            $this->user_name = $user_name;
        }
        else{ return "Name not valid!"; }


        if(is_string($user_lastname)){

            $this->user_lastname = $user_lastname;
        }
        else{ return "Lastname not valid!"; }


        if(is_string($display_name)){

            $this->display_name = $display_name;
        }
        else{ return "Display Name not valid!"; }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            $this->email = $email;
        }
        else{ return "E-mail not valid!"; }


        if($password != ""){

            $this->password = $password;
        }
        else{ return "Password not valid!"; }



        if($this->user_name != "" && $this->user_lastname != "" && $this->display_name != "" && $this->email != "" && $this->password != ""){

            $db_email = $this->server->query("SELECT email FROM users WHERE email = '$this->email'")->fetch_row();

            if(!$db_email[0]){

                    $this->server->query("INSERT INTO users (user_name, user_lastname, user_displayname, email,  password) VALUES ('$this->user_name', '$this->user_lastname', '$this->display_name', '$this->email', '$this->password')");
                    return "Your registration was successful. Now log in!";
            }
            else{ return "This E-mail already exists!"; }

        }
        else{ return "Fill all forms"; }

    }


    public function userLogin($email, $password){

        $id_password = $this->server->query("SELECT id, password FROM users WHERE email = '$email'")->fetch_row();

        if($id_password[1] == $password){

            $_SESSION['id'] = $id_password[0];

        }
    }

    public function adminLogin($email, $password){

        $id_password = $this->server->query("SELECT id, password FROM admin WHERE email = '$email'")->fetch_array();

        if($id_password[1] == $password){

            $_SESSION['id'] = $id_password[0];
        }
    }

    public function userLogout(){

        session_unset();
        session_destroy();
    }



}