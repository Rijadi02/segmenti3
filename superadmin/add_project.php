<?php
require_once '../includes/init.php';



if (isset($_POST["submit"])) {

  
        $project = new Project();
        
        $project->name = htmlspecialchars($_POST["name"]);
        $project->manager = htmlspecialchars($_POST["manager"]);
        $project->agents = htmlspecialchars($_POST["agents"]);

        if ($project->save()) {
            echo '<script>alert("Projekti u regjistrua me sukses")</script>';
        } else {
            echo "Error: " . $project . " " . mysqli_error($connect);
        }
    
}

?>


<div class="container mt-n10">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Bootstrap Form Controls-->
            <div id="default">
                <div class="card mb-4">
                    <div class="card-header">Default Bootstrap Form Controls</div>
                    <div class="card-body">
                        <!-- Component Preview-->
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form method="POST" action="" class="">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label>Manager</label>
                                        
                                        <select name="manager" class="form-control" id="">
                                        <option value="0">----</option>
                                            <?php foreach(User::find_by_role(1) as $manager):?>
                                                <option value="<?php echo $manager->id ?>"><?php echo $manager->username ?></option>
                                            <?php endforeach;?>    
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Agents</label>
                                        <input type="number" class="form-control" name="agents">
                                    </div>

                                  
                                    <div class="form-group">
                
                                    <input type="submit" class="btn btn-primary" name="submit">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <?php require_once '../includes/templates/foot.php'; ?>