<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
table{
    border-collapse: collapse;
    width:80%;
    color:black;
    font-family: monospace;
    font-size: 25px;
    text-align: left;
    margin-left: 60px;
}
th{
    background-color: green;
    color: white;
}
tr:nth-child(even){background-color: grey;}
button{
    background-color: red;
    border-radius: 5px;
    margin-left:80px;
}
    </style>


</head>
<body>
   <table>
    <tr>
    <th>id</th>
        <th>NAME</th>
        <th>CONTACT</th>
        <th>INDATE</th>
        <th>OUTDATE</ th>
        <th>CNI</th>
        <th>AMOUNT</th>
        
    </tr>
    
    <?php
 
    //creating location
    //database connection
        $conn = new mysqli("localhost","root","","hotel");
        //vcerifying connection
        if($conn->connect_error){
            echo ("connection failed: " .$conn->connect_error); 
    }
    $sql = "SELECT id,name, contact, indate,outdate,cni,amount from mores";
       $result=$conn->query($sql);
    if($result->num_rows>0){
while($row=$result->fetch_assoc()){

    echo"<tr>
    <td>".$row["id"]."</td>
    <td>".$row["name"]."</td>
    <td>".$row["contact"]."</td>
    <td>".$row["indate"]."</td>
    <td>".$row["outdate"]."</td>
    <td>".$row["cni"]."</td>
    <td>".$row["amount"]."</td>
    <td>"."<a href = 'del.php?id=$row[id]'>delete</a>"."</td>
     <td>"."<a href = 'update.php?id=$row[id]'>update</a>"."</td>
</tr>";
}
echo"</table>";
        }
else{
    echo "0 result";
}
        
    $conn->close();
   ?>
</table> 
</body>
</html>

