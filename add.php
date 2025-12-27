<?php
$conn = new mysqli("localhost", "root", "", "hotel");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $picture = $_FILES['picture']['name'];
    $dept = $_POST['depart'];
    $role = $_POST['role'];
    $contact = $_POST['contact'];
    if (!preg_match("/^6\d{8}$/", $contact)) {
        echo "<script>
        alert('invalide contact');
        window.history.back();
        </script>";
        exit();
    }

    $sql = "INSERT INTO staff (name,picture, depart, role, contact) 
            VALUES ('$name','$picture', '$dept', '$role', '$contact')";

    if ($conn->query($sql)) {
        $worker = "worker/";
        if (!is_dir($worker)) {
            mkdir($worker, 0777, true);
        }
        $tmp_name = $_FILES['picture']['tmp_name']; //create temp location for image
        $permenantly = $worker . basename($picture); //create permenant location
        move_uploaded_file($tmp_name, $permenantly);
        echo "<script>alert('registration succesfull')</script>";
        header("Location:admin.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Staff</title>
</head>
<style>
    #staff {
        width: 100px;
        background-color: rgb(221, 231, 247);
        height: 500px;
        width: 300px;
        border-radius: 10px;
        display: block;
        position: fixed;
        top: 5%;
        left: 35%;

    }

    input {
        width: 250px;
        height: 24px;
    }

    #al {
        margin-left: 10px;
    }

    #can {
        background-color: red;
        border-radius: 5px;
        width: 70px;
        height: 30px;
        margin-left: 30px;

    }

    #submit {
        background-color: green;
        border-radius: 5px;
        width: 70px;
        height: 30px;
    }

    h2 {
        font-size: xx-large;
        text-align: center;
    }a{
        text-decoration: none;
    }
</style>

<body>

    
    <form method="POST" id="staff" enctype="multipart/form-data">
        <div id="al">
            <br>
            <h2><b>Add New Staff</b></h2>
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>picture:</label><br>
            <input type="file" name="picture"  required><br><br>

            <label>Department:</label><br>
            <input type="text" name="depart" required><br><br>
            <label>Role:</label><br>
            <input type="text" name="role" required><br><br>

            <label>Contact:</label><br>
            <input type="text" name="contact" required><br><br>

            <button onclick="yes" id="submit">Save</button>

            <button  id="can"><a href="admin.php">Cancel</a></button>
        </div>
    </form>
    <script>
        function yes() {
            if (!allFilled) {
                alert("Please fill in all fields");
                return false;
            }
            alert("are you sure?")
            document.getElementById("staff").style.display = "none";
        document.getElementById("list").style.filter = "none";}

        function add() {
        document.getElementById("staff").style.display = "block";
        document.getElementById("list").style.filter = "blur(5px)";}

    </script>

</body>

</html>