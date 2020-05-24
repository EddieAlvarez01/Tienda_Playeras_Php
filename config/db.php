<?php

class Database{

    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'db_shop_master');
        $db->query("SET NAMES 'utf8'");         //CODIFICAR CON UTF8 PARA Ñ, TILDES, ETC
        return $db;
    }

}