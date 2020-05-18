<?php

class Connect{

    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'db_shp_master');
        $db->query("SET NAMES 'utf8'");         //CODIFICAR CON UTF8 PARA Ñ, TILDES, ETC
        return $db;
    }

}