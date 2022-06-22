<?php

if ($_SERVER['HTTP_HOST'] != 'localhost') {
    $sql_db = 'USE ' . $dbname . ';';
}