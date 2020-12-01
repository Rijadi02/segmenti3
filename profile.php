<?php

require_once("includes/init.php");

$pass_msg_type = "danger";
$msg_type = "danger";
$user = is_logged_in();

if(isset($_POST['password_submit']))
{
    $oldpassword = htmlspecialchars($_POST['oldpassword']);
    $password = htmlspecialchars($_POST['password']);
    $password1 = htmlspecialchars($_POST['password1']);
    if(bcheck($oldpassword, $user->password))
    {
        if($password == $password1)
        {
            $user->password = bhash($password);
            $user->save($user->id);
            $pass_msg = "Fjalëkalimi u ndryshua me sukses!";
            $pass_msg_type = "success";

        }else
        {
            $pass_msg = "Fjalëkalimat nuk janë te njejtë!";
        }
    }else
    {
        $pass_msg = "Keni gabuar fjalëkalimin!";
    }
}

if(isset($_POST['submit']))
{
    $name = htmlspecialchars($_POST['name']);
    $school = htmlspecialchars($_POST['school']);
    $email = htmlspecialchars($_POST['email']);

    if(!User::user_exists($email) || $email == $user->email)
    {
        $user->name = $name;
        $user->school = $school;
        $user->email = $email;
        
        if($user->save($user->id))
        {
            $msg = "Te dhenat ndryshuan me sukses!";
            $msg_type = "success";
        }else
        {
            $msg = "Pati problem ne ndryshimin e te dhenave, provoni perseri!";
        }
    }else
    {
        $msg = "Emaili eshte i zene, ju lutem perdorni email tjeter!";
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
    <title>Atomos</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="assets/css/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" /> -->
    <script data-search-pseudo-elements defer src="assets/js/all.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="nav-fixed sidenav-toggled">

<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">

                        <div class="page-header-content pt-4">



                            <ul class="navbar-nav align-items-end ml-auto">




                                <li class="nav-item dropdown no-caret dropdown-user">
                                    <a class="btn btn-icon btn-white dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="user"></i></a>
                                    <div class="dropdown-menu mt-1 dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                                        <h6 class="dropdown-header">
                                            <span class="dropdown-user-img btn btn-icon "><i data-feather="user"></i></span>
                                            <div class="dropdown-user-details">
                                                <div class="dropdown-user-details-name"><?php echo $user->name ?></div>
                                                <div class="dropdown-user-details-email"><?php echo $user->email ?></div>
                                            </div>
                                        </h6>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                                            Account
                                        </a>
                                        <a class="dropdown-item" href="logout">
                                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>



                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <a class="btn btn-white text-primary mb-5" href=".">
                                        < Prapa</a> <h1 class="page-header-title">
                                            <div class="page-header-icon mr-3"><i data-feather="edit"></i></div>
                                            Profili
                                            </h1>
                                            <div class="page-header-subtitle">Këtu mund te ndryshosh profilin</div>

                                </div>

                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-n10">
                    <div class="container mt-n10">
                        <div class="row">
                            <div class="col-xxl-4 col-xl-12 mb-4">

                            </div>

                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="card col-lg-5 ml-4 mb-5 p-0" >
                                        <div class="card-header">Ndrysho fjalëkalimin</div>
                                        <div class="card-body">

                                            <form action="" method="POST">
                                                <?php if(isset($pass_msg)) : ?>
                                                    <p class="alert alert-<?php echo $pass_msg_type; ?> text-center"><?php echo $pass_msg; ?></p>
                                                <?php endif; ?>

                                                <!-- "Name" form for languages  -->
                                                <label for="oldpassword" class="col-form-label">Fjalëkalimi i vjeter</label>
                                                <input id="oldpassword" type="password" required name='oldpassword' class="form-control" value="" autocomplete="name" autofocus>

                                                <label for="password" class="col-form-label">Fjalëkalimi i ri <span class="text-warning">(8 shkronja e me shumë)</span></label>
                                                <input id="password" minlength="8" type="password" name='password' required class="form-control" value="" autocomplete="name" autofocus>

                                                <label for="password1" class="col-form-label">Konfirmo fjalëkalimin</label>
                                                <input id="password1" minlength="8" type="password" name='password1' required class="form-control" value="" autocomplete="name" autofocus>




                                                <!-- End of  "Name"-->
                                                <div class="form-group mt-3">
                                                    <button type="submit" name="password_submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>




                                        </div>
                                    </div>

                                    <div class="card col-lg-6 ml-5 mb-5 p-0" >
                                        <div class="card-header">Ndrysho të dhenat</div>
                                        <div class="card-body">

                                            <form action="" method="POST">
                                            <?php if(isset($msg)) : ?>
                                                    <p class="alert alert-<?php echo $msg_type; ?> text-center"><?php echo $msg; ?></p>
                                                <?php endif; ?>

                                                <!-- "Name" form for languages  -->
                                                <label for="name" class="col-form-label">Emri i juaj</label>
                                                <input id="name" type="text" required name='name' class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $user->name ?>">

                                                <?php if($user->type == 1) : ?>
                                                    <label for="school" class="col-form-label">Emri i komunes</label>
                                                    <input id="school" type="text" required name='school' class="form-control" value="<?php echo isset($_POST['school']) ? $_POST['school'] : $user->school ?>">
                                                <?php elseif($user->type == 2) : ?>
                                                    <label for="school" class="col-form-label">Emri i shkolles</label>
                                                    <input id="school" type="text" required name='school' class="form-control" value="<?php echo isset($_POST['school']) ? $_POST['school'] : $user->school ?>">
                                                <?php else : ?>
                                                    <input id="school" type="hidden" name='school' class="form-control" value="">
                                                <?php endif ?>

                                                <label for="email" class="col-form-label">Emaili</label>
                                                <input id="email" type="email" required name='email' class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user->email ?>">




                                                <!-- End of  "Name"-->
                                                <div class="form-group mt-3">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>




                                        </div>
                                    </div>

                                  
                                </div>
                            </div>

            </main>
            <footer class="footer mt-auto container footer-light">
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
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script> -->
</body>

</html>