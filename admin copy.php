<?php

require_once("includes/init.php");

$user = logged_in(1);

$msg_type = "danger";
$db_msg_type = "danger";

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $role_id = htmlspecialchars($_POST['role_id']);
   
    $password = htmlspecialchars($_POST['password']);

    if(!Users::user_exists($name))
    {
        $new_user = new Users();

        $new_user->username = $name;
        $new_user->role_id = $role_id;
        $new_user->password = bhash($password);

      

        if ($new_user->save()) {
            $msg = "Perdoruesi u regjistrua me sukses";
            $msg_type = "success";
        } else {
            $msg = "Pati problem ne regjistrimin e perdoruesit!";
        }
    }else
    {
        $msg = "User name eshte i zene!";
    }
    
}

if (isset($_POST['delete'])){
    Users::delete_children(htmlspecialchars($_POST['delete']));
    $db_msg_type = "success";
    $db_msg = "DKA u shlye me sukses";
}

$children = $user->get_all_children();

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


<!-- Modal -->
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
                                        <a class="dropdown-item" href="profile">
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
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon mr-3"><i data-feather="book-open"></i></div>
                                        Shkollat
                                    </h1>
                                    <div class="page-header-subtitle">Këtu janë të gjitha shkollat</div>
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
                                    <div class="card col-lg-12 ml-1 mb-5 p-0">
                                        <div class="card-header">Shto shkolle</div>
                                        <div class="card-body">

                                            <form action="" method="POST">
                                                <?php if (isset($msg)) : ?>
                                                    <p class="alert alert-<?php echo $msg_type; ?> text-center"><?php echo $msg; ?></p>
                                                <?php endif; ?>
                                                <?php if (isset($mail_msg)) : ?>
                                                    <p class="alert alert-<?php echo $mail_msg_type; ?> text-center"><?php echo $mail_msg; ?></p>
                                                <?php endif; ?>


                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <label for="school" class="col-form-label">Emri i Shkolles</label>
                                                        <input id="school" type="text" name='school' value="<?php echo isset($_POST["school"]) ? $_POST["school"] : "" ?>" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="name" class="col-form-label">Emri i përgjegjesit</label>
                                                        <input id="name" type="text" name='name' value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <label for="email" class="col-form-label">Emaili i përgjegjesit</label>
                                                        <input id="email" type="email" name='email' value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="password" class="col-form-label">Fjalekalimi <span class="text-warning">(8 shkronja e me shumë)</span></label>
                                                        <input id="password" minlength="8" type="text" name='password' value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "" ?>" class="form-control" required>
                                                    </div>
                                                </div>







                                                <!-- End of  "Name"-->
                                                <div class="form-group mt-3">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>




                                        </div>
                                    </div>

                                    <div class="card col-lg-12 ml-1 p-0 ">

                                        <div class="card-header">Te gjitha shkollat</div>
                                        <div class="card-body">
                                        <?php if (isset($db_msg)) : ?>
                                                    <p class="alert alert-<?php echo $db_msg_type; ?> text-center"><?php echo $db_msg; ?></p>
                                                <?php endif; ?>
                                            <div class="datatable" style="overflow-x:auto;">
                                                <table class="table table-bordered table-hover overflow-auto" style="overflow: auto;" id="" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>DKA</th>
                                                            <th>Emri</th>
                                                            <th>Email</th>
                                                            <th>Tjera</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>DKA</th>
                                                            <th>Emri</th>
                                                            <th>Email</th>
                                                            <th>Tjera</th>

                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php foreach ($children as $child) : ?>
                                                            <tr>
                                                                <td><?php echo $child->id ?></td>
                                                                <td><?php echo $child->school ?></td>
                                                                <td><?php echo $child->name ?></td>
                                                                <td><?php echo $child->email ?></td>

                                                                <td>
                                                                    <form action="edit/admin" method="GET" style="display: inline;">
                                                                    <button name="id" type="submit" value="<?php echo $child->id ?>" class="btn btn-datatable btn-icon text-primary mr-2" ><i data-feather="edit"></i></button>
                                                        </form>


                                                                    <button class="btn btn-datatable btn-icon text-danger" type="button" onclick="delete_id('<?php echo $child->id ?>')" data-toggle="modal" data-target="#deleteModal"><i data-feather="trash-2"></i></button>


                                                                </td>

                                                            </tr>
                                                        <?php endforeach ?>

                                                            <script>
                                                                function delete_id(id)
                                                                {
                                                                    console.log("hello");
                                                                    document.getElementById("deleteButton").value = id;
                                                                }
                                                            </script>


                                                    </tbody>
                                                </table>
                                            </div>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered Modal</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">Deshironi te fshini DKA-në! <p class=" text-orange ">
                Vemendje: Te gjitha te dhenat me te do fshihen!</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                <button type="submit" name="delete" id="deleteButton" class="btn btn-danger">Fshije</button>
            </form>
        </div>
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