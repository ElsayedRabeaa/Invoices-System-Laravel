<?php
define('LOCALHOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DBNAME','invoices');
$connection=new mysqli(LOCALHOST,USER,PASSWORD,DBNAME);
if($connection){
    echo "start coding";
}