<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotel Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php

    //creating location
    //database connection
    $conn = new mysqli("localhost", "root", "", "hotel");

    $countresult = $conn->query("SELECT COUNT(*)AS total from mores");
    $countrow = $countresult->fetch_assoc();
    $TOTALGUEST = $countrow['total'];
    $totalrooms = $countrow['total'];

    $paymentresult = $conn->query("SELECT sum(amount) AS totalam from mores");
    $payrow = $paymentresult->fetch_assoc();
    $amount = $payrow['totalam'];
    $conn->close();
    ?>


    <!-- Sidebar -->
    <div class="sidebar">

        <h2>Hotel Admin</h2>
        <ul>
            <li class="active" onclick="showSection('dashboard')"><i class="fas fa-chart-line"></i> Dashboard</li>
            <li onclick="showSection('guests')"><i class="fas fa-user"></i> Guests</li>
            <li onclick="showSection('rooms')"><i class="fas fa-bed"></i> Rooms</li>


            <li onclick="showSection('staff')"><i class="fas fa-users"></i> Staff</li>


            <li onclick="showSection('support')"><i class="fas fa-life-ring"></i> Support</li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main">

        <!-- Dashboard -->
        <div id="dashboard" class="section">
            <div class="header">Dashboard Overview</div>
            <div class="cards">
                <div class="card">
                    <h3>Total Guests</h3>
                    <p><?= $TOTALGUEST ?></< /p>
                </div>
                <div class="card">
                    <h3>Occupied Rooms</h3>
                    <p><?= $totalrooms ?>/ 90</p>
                </div>
                <div class="card">
                    <h3>Revenue Today</h3>
                    <p><?= $amount ?></p>
                </div>

            </div>
        </div>

        <!-- Guests -->
        <div id="guests" class="section hidden">

            <!-- Dashboard Cards -->
            <div class="dashboard">
                <div class="card">
                    <h2>Total Guests</h2>
                    <p id="totalGuests"><?= $TOTALGUEST ?></p>
                </div>
                <div class="card">
                    <h2>Occupied Rooms</h2>
                    <p id="occupiedRooms"><?= $totalrooms ?></p>
                </div>

            </div>

            <!-- Guest Form -->
            <div class="table-container">
                <h2>Guest Information</h2>
                <table>
                    <tr>
                        <th>id</th>
                        <th>NAME</th>
                        <th>CONTACT</th>
                        <th>INDATE</th>
                        <th>OUTDATE</th>
                        <th>CNI</th>
                        <th>AMOUNT</th>
                        <th>Action</th>

                    </tr>

                    <?php

                    //creating location
                    //database connection
                    $conn = new mysqli("localhost", "root", "", "hotel");
                    //vcerifying connection
                    if ($conn->connect_error) {
                        echo ("connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id,name, contact, indate,outdate,cni,amount from mores";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>
      <td> $row[id] </td>
      <td>$row[name] </td>
      <td>$row[contact]</td>
      <td>$row[indate]</td>
      <td> $row[outdate]</td>
      <td>$row[cni]</td>
      <td>$row[amount]</td>
    <td><button id=del><a href = 'del.php?id=$row[id]'>delete</a></button></td>
    
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
        </div>

        <!-- Rooms -->
        <div id="rooms" class="section hidden">

            <div class="header">Room Management</div>
            <p>View, add, edit or delete rooms. Check room availability & pricing.</p>

        </div>

        <!-- Staff -->
        <div id="staff" class="section hidden">
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
            <button id=del><a href = 'staffdel.php?id=$row[id]'>delete</a></button>
            <button id=mod onclick=mod><a href = 'update.php?id=$row[id]'>modify</a></button>
            </td>
        </tr>
            ";
                        }
                    }

                    $conn->close();
                    ?>
                </table>
            </div>
        </div>




        <!-- Support -->
        <div id="support" class="section hidden">
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
          <td>$row[id]</td>
          <td>$row[name]</td>
          <td>$row[email]</td>
          <td>$row[message]</td>
<td><button id=del><a href = 'suppdel.php?id=$row[id]'>delete</a></button></td>
           
          </tr>";
                        }
                    }

                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
        <script>
            function showSection(sectionId) {
                document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
                document.getElementById(sectionId).classList.remove('hidden');

                document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
                event.target.closest('li').classList.add('active');
            }
        </script>

</body>

</html>