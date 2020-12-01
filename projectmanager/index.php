<?php
require_once '../includes/init.php';
$user = isAuth(1);
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
                            <div class="datatable">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Manager</th>
                                                <th>Agents</th>
                                                <th>Actions</th>
                                              
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Manager</th>
                                                <th>Agents</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach(Project::find_by_manager($user->id) as $project): ?>
                                            <tr>
                                                <td><?php echo $project->id ?></td>
                                                <td><?php echo $project->name ?></td>
                                                <td><?php echo $project->manager ?></td>
                                                <td><?php echo $project->agents ?></td>
                                                <td>
                                                <a href="project?id=<?php echo $project->id?> " class="btn btn-primary" >Go to project</a>   
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