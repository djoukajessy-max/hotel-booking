<style>
    

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
    color: #fff;
}
#de{
background-color:red;
border-radius: 5px;
width: 50px;
height: 30px;
border: transparent;


}
#mod{
background-color:green;
border-radius: 5px;
width: 50px;
height: 30px;
border: transparent;
color: white;
}
#add{
    width: 100px;
    height: 40px;
    background-color:green;
border-radius: 5px;
border: transparent;
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
    <h2>STAFF LIST</h2>
    <button id="add" onclick="add"><a href='add.php'>ADD STAFF</a></button>
    <table>
        <tr>
            <th>id</th>
            <th>NAME</th>
            <th>pictures</th>
            <th>Departemnt</th>
            <th>Role</th>
            <th>CONTACT</th>
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

        $sql = "SELECT * from staff";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <td>$row[id]</td>
            <td>$row[name]</td>
            <td><img style = 'width:100px; height:100px; border-radius:50px;' src = 'worker/$row[picture]'></td>
            <td>$row[depart]</td>
            <td>$row[role]</td>
            <td>$row[contact]</td>
            <td>
            <button id=de><a href = 'staffdel.php?id=$row[id]'>delete</a></button>
            <button id=mod onclick=mod><a href = 'update.php?id=$row[id]'>modify</a></button>
            </td>
        </tr>
            ";
            }}

        $conn->close();
        ?>
    </table>
</div>