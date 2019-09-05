<?php
    include "connection.php";
    if(!isset($_GET['email'])) $_GET['email']='';
    else {
        $query = 'SELECT * FROM signup WHERE email="'.$_GET['email'].'"';
        $res = mysqli_query($conn, $query);
       echo mysqli_num_rows($res)>0?'true':'false';
    }
?>