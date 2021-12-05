<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DUSC";

    $conn=new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username=$_POST['email'];
    $userpwd=$_POST['password'];

    function validate_email()
    {
        global $conn,$username;
        $sql = "SELECT email from profiles";
        if ($result = mysqli_query($conn, $sql)) 
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($row["email"]==$username)
                    return true;
            }
            return false;
            mysqli_free_result($result);
        }
        else
        {
            return false;
        }        
    }
    
    function validate_pwd()
    {
        global $conn,$username,$userpwd;
        $sql = "SELECT Userpwd FROM profiles WHERE email='$username'";
        if($result = mysqli_query($conn,$sql))
        {
            if (mysqli_num_rows($result) > 0) 
            {
                $row = mysqli_fetch_assoc($result);
                if($row["Userpwd"]==$userpwd)
                    return true;
                else   
                    return false;
            } 
            else 
            {
                return false;
            }
        }
        else
            return false;
    }

    if (isset($_POST["login"])) {
        if(validate_email())
        {
            if(validate_pwd())
            {
                echo "Welcome $username";
            }
            else
            {
                echo "<script>alert('INVALID PASSWORD');parent.location.href='Login.html';</script>";
            }
        }
        else
        {
            echo "<script>alert('INVALID EMAIL');parent.location.href='Login.html';</script>";
        }
    }
    $conn->close();
?>