<?php

require_once("./includes/init_wh.php");
error_reporting(0);

$msg = '';

if(isset($_SESSION['user_id'])){
    type_redirect(User::find_by_id($_SESSION['user_id'])->role_id);
}

if(isset($_POST["submit"]))
{
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if($user = User::user_exists($username))
    {
        if(bcheck($password, $user->password))
        {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user->id;
            type_redirect($user->role_id);
        }else
        {
            $msg .= "Wrong password!";
        }
    }else
    {
        $msg = "User does not exist!";
    }
}

?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin Pro</title>
        <link href="./assets/css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="./assets/assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <!-- Login form-->
                                        <form method="post" action="" >
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" type="text" placeholder="Enter username" name="username"/>
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" type="password" placeholder="Enter password" name="password" />
                                            </di   v>
                                            <!-- Form Group (remember password checkbox)-->
                                         
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                               
                                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                        <?php echo $msg?>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>
