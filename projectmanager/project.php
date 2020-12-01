<?php
require_once '../includes/init.php';
$user = isAuth(1);
$project = Project::find_by_id($_GET['id']);
if($project->manager != $user->id){
    redirect('/segmenti3/projectmanager/index');
}
$agents_working = 0;

foreach(SubProject::find_by_project($project->id) as $subproject){
    $agents_working = $agents_working + $subproject->agents;
}

if (isset($_POST["submit"])) {

    $all_agents = $agents_working + htmlspecialchars($_POST["agents"]);
    
    if($all_agents <= $project->agents){
        $subproject = new SubProject();
        $subproject->project_id = $project->id;
        $subproject->site_manager = htmlspecialchars($_POST["manager"]);
        $subproject->agents = htmlspecialchars($_POST["agents"]);
        if ($subproject->save()) {
         echo '<script>alert("Projekti u regjistrua me sukses")</script>';
        } else {
            echo "Error: " . $project . " " . mysqli_error($connect);
        }
    }else{
        echo '<script>alert("Ka me shume agjenta")</script>';
    }
}
?>

<div class="container mt-n10">
    <div class="row">
        <div class="col-lg-6">
            <!-- Default Bootstrap Form Controls-->
            <div id="default">
                <div class="card mb-4">
                 
                    <div class="card-header">Number of agents needed: <b><?php echo $project->agents - $agents_working ?></b> </div>
                    <div class="card-body">
                        <!-- Component Preview-->
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form method="POST" action="" class="">


                                    <div class="form-group">
                                        <label>Site Manager</label>

                                        <select name="manager" class="form-control" id="">
                                            
                                            <?php foreach (User::find_by_role(2) as $manager) : ?>
                                                <option value="<?php echo $manager->id ?>"><?php echo $manager->username ?></option>
                                            <?php endforeach; ?>
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
        <div class="col-lg-6">
            <!-- Default Bootstrap Form Controls-->
            <div id="default">
                <div class="card mb-4">
                    <div class="card-header">Number of agents working on this project is: <b><?php echo  $agents_working ?> </b></div>
                    <div class="card-body">
                        <!-- Component Preview-->
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <div class="datatable">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Manager</th>
                                                <th>Agents</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Manager</th>
                                                <th>Agents</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach (SubProject::find_by_project($project->id) as $subproject) : ?>
                                                <tr>
                                                    <td><?php echo $subproject->id ?></td>
                                                    <td><?php echo $subproject->site_manager ?></td>
                                                    <td><?php echo $subproject->agents ?></td>
                                                    <td>
                                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                         
                                        </tbody>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    
    </div>


    <?php require_once '../includes/templates/foot.php'; ?>