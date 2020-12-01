<?php

    require_once("../includes/init.php");

    $msg_type = "danger";
    $db_msg_type = "danger";

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);
        $role_id = htmlspecialchars($_POST['role_id']);

        if(!User::user_exists($name))
        {
            $new_user = new User();
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
?>

                <!-- Main page content-->
                <div class="container mt-n10">
                    <div class="container mt-n10">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="card col-lg-12 ml-1 mb-5 p-0">
                                        <div class="card-header">Shto user</div>
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <?php if (isset($msg)) : ?>
                                                    <p class="alert alert-<?php echo $msg_type; ?> text-center"><?php echo $msg; ?></p>
                                                <?php endif; ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="name" class="col-form-label">Emri</label>
                                                        <input id="name" type="text" name='name' value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>" class="form-control" required>
                                                    </div>
                                     
                                                    <div class="col-lg-12">
                                                        <label for="role_id" class="col-form-label">Roli</label>
                                                        <select name="role_id" id="role_id" class="form-control">
                                                                <option value="0">Super Admin</option>
                                                                <option value="1">Project Manager</option>
                                                                <option value="2">Site Manager</option>
                                                                
                                                        </select>
                                                        <!-- <input id="role_id" type="text" name='role_id' value="<?php echo isset($_POST["role_id"]) ? $_POST["role_id"] : "" ?>" class="form-control" required> -->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="password" class="col-form-label">Fjalekalimi <span class="text-warning">(8 shkronja e me shumë)</span></label>
                                                        <input id="password" minlength="8" type="password" name='password' value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "" ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </main>

<?php require_once('../includes/templates/foot.php') ?>