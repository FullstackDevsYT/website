<?php

require('database.php');

class User {

    public $handler;

    function __construct()
    {

        $db_connection = new database();
        $this->handler = $db_connection->connect();

        return $this->handler;

    }

    function newUser($email,$username,$password){

        $salt = rand(1000000,9999999);

        $hashed_pass = sha1(md5(crypt($password,$salt)));

        $this->query = $this->handler->prepare("INSERT INTO users (email,username,password,salt) VALUES(?,?,?,?)");
        $values = array($email,$username,$hashed_pass,$salt);
        $this->query->execute($values);

        $num_rows = $this->query->rowCount();

        if($num_rows > '0'){

            return true;

        }else{

            return false;

        }

    }

    function getUser($username){

        $this->query = $this->handler->query("SELECT * FROM users WHERE username = '$username'");

        $num_rows = $this->query->rowCount();

        if($num_rows > '0'){

            $rows = $this->query->fetch(PDO::FETCH_ASSOC);

            while($rows){

                return $rows;

            }

            return false;

        }else{

            return false;

        }

    }

    function login($username,$password){

        $user = $this->getUser($username);

        if(is_array($user)){

            $salt = $user['salt'];

            $password = $hashed_pass = sha1(md5(crypt($password,$salt)));

            $this->query = $this->handler->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

            $num_rows = $this->query->rowCount();

            if($num_rows == '1'){

                return true;

            }else{

                return false;

            }

        }



    }

}