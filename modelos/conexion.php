<?php

class ConexionBD{

    static public function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=posgenerico","root","");

        $link->exec("set names utf8");

        return $link;
    }
}