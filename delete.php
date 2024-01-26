<?php 

$con = mysqli_connect("localhost","root","","practice") or (die("connection failed"));

if(isset($_GET['delid'])){
    $id = $_GET['delid'];

    $select = "SELECT * FROM `practice_tb` WHERE `id` = $id ";
    $res = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($res);
    $image = $row["image"];
    unlink("$image");
    
    $sql = "DELETE FROM `practice_tb` WHERE `id` = $id ";
    $result = mysqli_query($con,$sql);
    if($result){
        header("location: show.php");
    }
}
