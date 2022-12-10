<?php

class Conexion{

    public function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=posgenerico","root","");

        $link->exec("set name utf8");

        return $link;
    }
}