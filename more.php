<?php
//creating location

$name = $_POST['name'];
$contact = $_POST['contact'];
if(!preg_match("/^6\d{8}$/",$contact)){
    echo"<script>
    alert('invalide contact');
    window.history.back();
    </script>";
    exit();
    }
$indate = $_POST['indate'];
$outdate = $_POST['outdate'];
$room = $_POST['room'];
$amount = $_POST['amount'];
$pm = $_POST['pm'];
$cni = $_POST['cni'];

//check if all fields are filed 
if(empty($name)||empty($contact)||empty($indate)||empty($outdate)||empty($room)||empty($amount)||empty($pm)||empty($cni)){
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
$stmt=$conn->prepare("insert into mores(name,contact,indate,outdate,room,amount,pm,cni) values(?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssiss",$name,$contact,$indate,$outdate,$room,$amount,$pm,$cni);
$stmt->execute();

echo "registration sucessfull";
//header("location:privacy.html");//used to direct to another page ater submitted
exit();
    }
$stmt->close();
$conn->close();
    
?>
