<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    


    <style>
    body{
        background-color: bisque;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    
    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    
    th {
        background:orange;
        
    }
    
    tr:hover {
        background: #f9f9f9;
       
    }
    a{ color: black;
        text-decoration: none;
    }
    #del{
    background-color:red;
    border-radius: 5px;
    width: 50px;
    height: 30px;
    }
   
    .list{
        background: white;
        padding:30px;
        border-radius: 12px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);}
       .list h2{
        margin-top: 5px;
        font-size: xx-large;
    }
    </style>
    <div class="list">
        <h2>Guest Suggestions </h2>
        
        <table>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>message</th>
               <th>ACTION</th>
            </tr>
    
            <?php
    
            //creating location
            //database connection
            $conn = new mysqli("localhost", "root", "", "hotel");
            //vcerifying connection
            if ($conn->connect_error) {
                echo ("connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT * from support";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
    
                    echo "<tr>
          <td>" . $row["id"] . "</td>
          <td>" . $row["name"] . "</td>
          <td>" . $row["email"] . "</td>
          <td>" . $row["message"] . "</td>
<td>" . "<button id=del><a href = 'suppdel.php?id=$row[id]'>delete</a></button>" . "</td>
           
          </tr>";
                }
                echo "</table>";
            } else {
                echo "0 result";
            }
    
            $conn->close();
            ?>
        </table>
    </div>
    </body>
</html>

