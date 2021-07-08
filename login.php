<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ROC - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-5">
                    <div class="col-lg-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="h5 text-gray-900">Room Occupancy Counter</h4>
                                <hr>
                                <h1 class="h4 text-gray-900 mb-4">Admin Page</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        name="username" aria-describedby="usernameHelp"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        name="password" placeholder="Password">
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Login">
                            </form>
                            <div class="text-center">
                            <?php 
                                if(isset($_POST['submit'])){
                                    $user = $_POST["username"];
                                    $pass = $_POST["password"];

                                    include "connect.php";
                                    //Cek Input Username & Pass
                                    $sql = "SELECT * FROM akun WHERE username='$user' AND password='$pass'" ;
                                    $login = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($login);
                                    $cek = mysqli_num_rows($login); 
                                    
                                    if($cek > 0){
                                        session_start();
                                        $_SESSION['username'] = $user;
                                        header("Location: index.php");
                                    }
                                    else{
                                        echo "Username / Password salah";
                                    }
                                }else{
                                    echo "Silahkan Login";
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>