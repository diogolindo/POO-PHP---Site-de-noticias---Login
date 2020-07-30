<?php
class Conexao {
    //PARÂMETROS:
    //("mysql:host=localhost;dbname=sistema_noticias", "root", "vertrigo")
    static public function getConexao(){
        return new PDO (SGBD.":host=".HOST_DB.";dbname=".DB."",USER_DB, PASS_DB);
    }

}