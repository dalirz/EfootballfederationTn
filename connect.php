<?php

$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='dalidali48';
$DATABASE='federation';

$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if(!$con){
    die(mysqli_error($con));
}


?>

