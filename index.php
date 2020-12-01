<?php

require_once("includes/init.php");
error_reporting(0);
login_redirect();


if(isset($_POST["submit"]))
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if($user = User::user_exists($email))
    {
        if(bcheck($password, $user->password))
        {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user->id;
            type_redirect($user->role_id);
        }else
        {
            $msg .= "Keni gabuar fjalëkalimin!";
        }
    }else
    {
        $msg = "Emaili nuk egziston!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="assets/js/all.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                                <!-- Social login form-->
                                <div class="card my-5">
                                    <div class="card-body p-5 text-center">
                                        <div class="h3 font-weight-light mb-0">Sign In</div>
                                        <!-- Social login links-->

                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body p-5">
                                        <?php if(isset($msg)) : ?>
                                            <p class="alert alert-danger text-center"><?php print_r($msg); ?></p>
                                        <?php endif; ?>
                                        <!-- Login form-->
                                        <form action="" method="POST">
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="text-gray-600 small" for="emailExample">Email address</label>
                                                <input class="form-control form-control-solid py-4" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>" name="email" type="email" placeholder="" aria-label="Email Address" aria-describedby="emailExample">
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="form-group">
                                                <label class="text-gray-600 small" for="passwordExample">Password</label>
                                                <input class="form-control form-control-solid py-4" required name="password" type="password" placeholder="" aria-label="Password" aria-describedby="passwordExample">
                                            </div>
                                            <!-- Form Group (forgot password link)-->
                                           
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mb-0">
                                                
                                                <button type="submit" name="submit" class="btn btn-primary mt-3 p-2 mx-auto" style="width:60%">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body px-5 py-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer mt-auto footer-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Your Website 2020</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
