<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn=new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Details</title>
    <style>
        td{
            vertical-align: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <table border="1" style="width:100%;">
        <tr>
            <th>Student Name</th>
            <th>Roll Number</th>
            <th>College Email</th>
            <th>Student Age</th>
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Societies Selected</th>
            <th>Course Selected</th>
            <th>Address</th>
            <th>Student Photo</th>
        </tr>
        <?php
            $sql="SELECT * FROM student_details";
            if($result=mysqli_query($conn,$sql))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $username=$row['StuName'];
                    $roll=$row['RollNo'];
                    $email=$row['email'];
                    $age=$row['age'];
                    $gen=$row['gen'];
                    $phn=$row['phone'];
                    $soc=$row['soc'];
                    $course=$row['course'];
                    $addr=$row['addr'];
                    $photo=$row['photo'];
                    echo "<tr>";
                    echo "<td>$username</td><td>$roll</td><td>$email</td><td>$age</td><td>$gen</td><td>$phn</td><td>$soc</td><td>$course</td><td>$addr</td><td><img width='150' height='150' src='data:image/jpeg;base64,".base64_encode($photo)."' title='Photo'></td>";
                    echo "</tr>";
                }
            }
            else    
                echo "Error Fetching details.";
            $conn->close();
        ?>
    </table>
</body>
</html>