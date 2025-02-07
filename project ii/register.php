<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5 m-auto bg-white shadow font-monospace border border-info">
            <p class="text-primary text-center fs-3 fw-bold my-3">User Register</p>
            <form action="" method="POST" >
                <div class="mb-3">
                    <label for="">UserName:</label>
                    <input type="text" name="name" placeholder="Enter User Name"  class = "form-control">
                </div>
                <div class="mb-3">
                    <label for="">UserEmail:</label>
                    <input type="email" name="email" placeholder="Enter User Email"  class = "form-control">
                </div>
                <div class="mb-3">
                    <label for="">UserNumber:</label>
                    <input type="number" name="number" placeholder="Enter User Number"  class = "form-control">
                </div>
                <div class="mb-3">
                    <label for="">UserPassword:</label>
                    <input type="password" name="password" placeholder="Enter User password"  class = "form-control">
                </div>
                <div class="mb-3">
                    <button name="submit" class ="w-100 bg-primary fs-4 text-white">REGISTER</button>

                </div>
                <div class="mb-3">
                <button class ="w-100 bg-success fs-4 text-white"> <a href="login.php" class="text-decoration-none text-white">ALREADY ACCOUNT</a></button>
                </div>
            </form>
                                
                    <?php
                    if(isset($_POST['submit'])){
                        $Name = $_POST['name'];
                        $Email = $_POST['email'];
                        $Number=$_POST['number'];
                        $Password = $_POST['password'];
                        if(empty($Name) || empty($Email) ){
                            echo "Please fill in all fields.";
                        }
                        if (strlen($Password) < 8) {
                            echo "
                                <script>
                                alert('Password must be at least 8 characters long');
                                window.location.href = 'register.php';
                                </script>
                            ";
                            exit();
                        }
                        if (strlen($Number) != 10) {
                            echo "
                                <script>
                                alert('Phone number should be 10 characters long');
                                window.location.href = 'register.php';
                                </script>
                            ";
                            exit();
                        }
            $Dup_Email = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE Email = '$Email' " );
            $Dup_UserName = mysqli_query($conn,"SELECT * FROM `tbl_user` WHERE UserName = '$Name' " );
                        if(mysqli_num_rows($Dup_Email)){
                            echo"
                            <script>
                            alert('This email is already taken');
                            window.location.href= 'register.php'
                            </script>
                            ";
                        }
                        if(mysqli_num_rows($Dup_UserName)){
                            echo"
                            <script>
                            alert('This user name is already taken');
                            window.location.href= 'register.php'
                            </script>
                            ";
                        }
                        else{
                            mysqli_query($conn, "INSERT INTO `tbl_user`( `UserName`, `Email`, `Number`, `Password`) 
                                    VALUES ('$Name','$Email','$Number','$Password')");
                                    echo"
                                    <script>
                                    alert('Register successfully');
                                    window.location.href= 'login.php';
                                    </script>
                                    ";
                        }
                    }

                    ?>
        </div>
    </div>
</div>
</body>
</html>