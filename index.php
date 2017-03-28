<?php

require_once('c/User.php');

$user = new User();

$username = 'fullstack';
$password = '123456';

$result = $user->newUser('a@a.a',$username,$password);

if($result){

    $u = $user->getUser($username);

    if(is_array($u)){

        echo '<pre>';
        echo $u['password'];
        echo '</pre>';

    }else{

        echo 'User successfully created, but unable to fetch';

    }


}else{

    echo 'unable to create user';

}

$login = $user->login($username,$password);

if($login){

    $_SESSION['username'] = $username;
    echo 'session set';

}else{

    echo 'Wrong Credentials';

}