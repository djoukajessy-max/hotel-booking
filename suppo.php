<?php

//creating location

$name = $_POST['sname'];
$email = $_POST['email'];
$message = $_POST['message'];
//check if all fields are filed 
if(empty($name)||empty($email)||empty($message)){
    echo "<script>alert('please all the fields are required');</script>";
    exit();
    }

    //database connection
    $conn = new mysqli("localhost","root","","hotel");
    //vcerifying connection
    if($conn->connect_error){
        echo ("connection failed: " .$conn->connect_error); 
}
    else{
$stmt=$conn->prepare("insert into support(name,email,message) values(?,?,?)");
$stmt->bind_param("sss",$name,$email,$message);
$stmt->execute();

echo "registration sucessfull";
header("location:hotel.html");//used to direct to another page ater submitted
exit();
    }
$stmt->close();
$conn->close();
    
?>