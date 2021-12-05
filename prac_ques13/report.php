<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn=new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function validate()
    {
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];    
        $roll=$_POST["roll"];
        $email=$_POST['Email'];
        $age=$_POST['age'];
        $gen=$_POST["Gender"];
        $phn=$_POST['tel'];
        $soc=$_POST['society'];
        $course=$_POST['course'];
        $addr=$_POST['address'];
        $img = $_FILES["photo"]["tmp_name"];
        if($fname==""||$mname==""||$lname==""||$roll==""||$email==""||$age==""||$gen==""||$phn==""||$soc==""||$course==""||$addr==""||$img=="")
        {
            echo "<script>alert('Please fill all columns');</script>";
           return false;
        }
        else
        {
            if(strlen($roll)!=4)
            {
                echo "<script>alert('Please fill valid roll number of 4 digits.');</script>";
                return false;
            }
            $temp=explode("@",$email);
            if($temp[sizeof($temp)-1]!="keshav.du.ac.in")
            {
                echo "<script>alert('Please fill valid college email.');</script>";
                return false;
            }
            if($age<16||$age>22)
            {
                echo "<script>alert('Please fill valid age between 16 and 22.');</script>";
                return false;
            }
            
            $temp=$_FILES["photo"]["type"];
            if($temp=="image/jpg"||$temp=="image/jpeg"||$temp=="image/png")
            {
                return true;
            }
            else
            {
                echo "<script>alert('Upload valid image type i.e. jpg/jpeg/png');</script>";
                return false;
            }
        }
    }

    if(isset($_POST['Submit']))
    {
        if(validate())
        {
            $sql="CREATE TABLE IF NOT EXISTS student_details(StuName VARCHAR(60) NOT NULL,RollNo VARCHAR(4) NOT NULL,email VARCHAR(50) NOT NULL,age TINYINT UNSIGNED NOT NULL,gen VARCHAR(6) NOT NULL,phone VARCHAR(10) NOT NULL,soc VARCHAR(50) NOT NULL,course VARCHAR(100) NOT NULL,addr VARCHAR(500) NOT NULL,photo LONGBLOB NOT NULL)";
            if(mysqli_query($conn,$sql))
            {
                if(isset($_FILES["photo"])){
                    $img=addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
                 }
                $roll=$_POST["roll"];
                $sqlt = "SELECT RollNo from student_details";
                if ($result = mysqli_query($conn, $sqlt)) 
                {
                    $rowcount=0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                        if($row["RollNo"]==$roll)
                            $rowcount++;
                    }

                    if($rowcount==0)
                    {
                        $sqls =$conn->prepare("INSERT INTO student_details (Stuname,RollNo,email,age,gen,phone,soc,course,addr,photo) VALUES (?,?,?,?,?,?,?,?,?,'$img')"); 
                        $sqls->bind_param("sssisssss",$username,$roll,$email,$age,$gen,$phn,$soc,$course,$addr);
                        $fname=$_POST['fname'];
                        $mname=$_POST['mname'];
                        $lname=$_POST['lname'];
                        $username=$fname." ".$mname." ".$lname;
                        $email=$_POST['Email'];
                        $age=$_POST['age'];
                        $gen=$_POST["Gender"];
                        $phn=$_POST['tel'];
                        $soc_temp=$_POST['society'];
                        $soc=implode(",",$soc_temp);
                        $course=$_POST['course'];
                        $addr=$_POST['address'];
                        $sqls->execute();
                        if ($sqls) 
                        {
                            echo "<script>alert('Student Details insertion successful.');location.href='ques13.html';</script>";
                        } 
                        else 
                        {
                            echo "<script>alert('Error uploading details, try again after some time.');location.href='ques13.html';</script>";
                                exit();
                        }
                    }
                    else
                    {
                        echo "<script>alert('Details already available with this Roll Number.');location.href='ques13.html';</script>";
                     exit();
                    }
                }
                else
                {
                    echo "<script>alert('Error uploading details, try again after some time.');location.href='ques13.html';</script>";
                    exit();
                }
            }
            else 
            {
                echo "<script>alert('Error uploading details, try again after some time.');location.href='ques13.html';</script>";
                exit();
            }
        }
        else
            echo "<script>location.href='ques13.html';</script>";
    }
    $conn->close();
?>