<?php   
$servername= "localhost";
$db_name= "velocity";
$username = "root";
$password = "";

$dbport="3366";
$con = mysqli_connect($servername, $username, $password, $db_name, $dbport);

if(!$con){
    echo "Not connected";
}          

?>  