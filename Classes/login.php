<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 10/12/2015
 * Time: 6:45 PM
 **/


class server {

    private $db_hostname;
    private $db_username;
    private $db_password;
    private $db_database;
    public $server;

    public function __construct($hostname, $username, $password, $database){

        $this->db_hostname = $hostname;
        $this->db_username = $username;
        $this->db_password = $password;
        $this->db_database = $database;

        $this->server = new mysqli($this->db_hostname, $this->db_username, $this->db_password, $this->db_database);

        if($this->server->connect_error){echo "Connection Error: ".$this->server->connect_error;}

    }



    public function select($fields, $table, $where = true){

        if($fields && $table){

            $fields = str_replace('\'', '', $fields);
            $fields = str_replace('"', '', $fields);
            preg_replace('/[^A-Za-z0-9\-]/', '', $table);

            $result = $this->server->query("SELECT $fields FROM $table WHERE $where");

        }
        else{ $result = "Error"; }

        return $result;
    }



    public function update($table, $column_value, $where = true){

        if($table && $column_value){

            $result = $this->server->query("UPDATE $table SET $column_value WHERE $where");
        }
        else{ $result = "Error";}

        return $result;
    }


    public function request_var($name, $type) {

        $value='';

        if(isset($_REQUEST[$name])){ $value = $_REQUEST[$name]; }

        if(in_array($type, array('int', 'float', 'text')) && is_array($value)){ return ''; }

        if($type == 'int'){ $value = intval(urldecode($value)); }

        else if($type == 'text'){ $value = trim(filter_var(strip_tags(urldecode($value)), FILTER_SANITIZE_STRING)); }

        else if($type == 'array'){

            $array = array();

            foreach($value as $key => $value){

                $array[$key] = trim(filter_var(strip_tags(urldecode($value)), FILTER_SANITIZE_STRING));
            }
            $value = $array;
        }
        return $value;
    }
}


