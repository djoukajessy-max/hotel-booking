<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <style>
        #staff {
            width: 100px;
            background-color: rgb(221, 231, 247);
            height: 500px;
            width: 300px;
            border-radius: 10px;
            display:block;
                position:fixed;
            top: 5%;
            left: 35%;
          
        }
        input{
            width: 250px;
            height: 24px;
        }
#al{
    margin-left:10px;
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
        h2{
            font-size: xx-large;
            text-align: center;
        }
    </style>
    <?php

    $conn = new mysqli("localhost", "root", "", "hotel");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM staff WHERE id=$id");
    $row = $result->fetch_assoc();

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

        $sql = "UPDATE staff SET name='$name',picture='$picture', depart='$dept', role='$role', contact='$contact' WHERE id=$id";


        if ($conn->query($sql)) {
            $worker = "worker/";
            if (!is_dir($worker)) {
                mkdir($worker, 0777, true);
            }
            $tmp_name = $_FILES['picture']['tmp_name']; //create temp location for image
            $permenantly = $worker . basename($picture); //create permenant location
            move_uploaded_file($tmp_name, $permenantly);
            

            header("Location:admin.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
   
    <form method="POST" id="staff">
    <h2>Edit Staff</h2>
        <div id="al">
        <br><label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label>picture:</label><br>
        <input type="text" name="picture" value="<?php echo $row['picture']; ?>" required><br><br>

        <label>Department:</label><br>
        <input type="text" name="depart" value="<?php echo $row['depart']; ?>" required><br><br>

        <label>Role:</label><br>
        <input type="text" name="role" value="<?php echo $row['role']; ?>" required><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?php echo $row['contact']; ?>" required><br><br>


        <button id="submit" onclick="ok()">Update</button>
        <button id="can" onclick="ca()"><a href="admin.php">cancel</a></button>
        </div>
    </form>


    <script>
        function ok() {
            if (!allFilled) {
                alert("Please fill in all fields");
                return false;
            }
            alert("are you sure?")
            document.getElementById("staff").style.display = "none";
        document.getElementById("list").style.filter = "none";}

        

         function mod() {
        document.getElementById("staff").style.display = "block";
        document.getElementById("list").style.filter = "blur(5px)";}

    </script>
</body>

</html>