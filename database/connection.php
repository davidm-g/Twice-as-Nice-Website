<?php
function getDatabaseConnection(){
        $db = new PDO('sqlite:database/site.db');
        return $db;
}
function getDatabaseConnection_folder(){
        $db = new PDO('sqlite:../database/site.db');
        return $db;
}
function generate_random_token() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }