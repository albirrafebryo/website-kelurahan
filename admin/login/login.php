<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // // Cek username dan password di database
    // $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
    // $result = mysqli_query($kon, $sql);

    if ($username == 'pajang' && $password == 'pajang123') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['success'] = 'Login Berhasil!';
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center ">
            <div class="col-xl-5">
                <div class="card text-center fade-in">
                    <!-- <div class="card-header bg-primary text-white text-center h3">ADMIN</div> -->
                    <div class="card-body p-md-4 mx-md-4">
                        <div class="text-center">
                            <img src="../assets/img/logo.png" alt="logo">
                            <h4 class="mt-3 mb-2 pb-1">SISTEM INFORMASI UMKM KELURAHAN PAJANG</h4>
                        </div>
                        <?php if (isset($error)) : ?>
                            <div class="alert"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-2">
                                <label for="username" class="form-label"></label>
                                <input type="text" autocomplete="off" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"></label>
                                <input type="password" autocomplete="off" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-success">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>