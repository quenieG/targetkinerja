<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IKU - Login</title>
    <link rel="icon" href="../../assets/images/poltesa.jpg">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-info">
    </br>
    </br>
    </br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Tampilkan pesan sukses -->
                        <?php
                        session_start();
                        if (isset($_SESSION['message']) && $_SESSION['msg_type'] == 'success') {
                            echo '<div class="alert alert-success text-center">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']);
                            unset($_SESSION['msg_type']);
                        } 
                        if (isset($_SESSION['message']) && $_SESSION['msg_type'] == 'error') {
                            echo '<div class="alert alert-danger text-center">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']);
                            unset($_SESSION['msg_type']);
                        }
                        ?>
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="../../assets/images/poltesa.jpg" alt="gambar" width="500" height="500">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <form class="user" action="../../action/auth/login.php" method="POST">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="register.php">Register Here</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html> 