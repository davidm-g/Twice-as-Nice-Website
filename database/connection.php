<?php
function getDatabaseConnection(){
        $db = new PDO('sqlite:database/site.db');
        return $db;
}
