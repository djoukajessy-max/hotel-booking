<?php
$conn = new mysqli("localhost", "root", "", "hotel");

if ($conn->connect_error) {
die("Connection failed: " .$conn->connect_error);
}
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM mores WHERE $id=id";
    $result = $conn->query($sql);
    if($result == true) {
        header("Location:admin.php");
        exit();
    }
}

    $conn->close();
?>

