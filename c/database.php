<?php


class database{

    protected $handler;
    public $host = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $db = 'fullstack_devs';

    function connect(){

        try{

            $this->handler = new PDO("mysql:host=$this->host;dbname=$this->db",$this->user,$this->pass);
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->handler;

        } catch(PDOException $e){

            echo 'Error: '.$e;

        }

    }

}
