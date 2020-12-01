<?php
require_once '../includes/init.php';
$user = isAuth(2);
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
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Manager</th>
                                           
                                                <th>Actions</th>
                                            
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach(Agents::find_by_site($user->id) as $agent): ?>
                                            <tr>
                                                <td><?php echo $agent->id ?></td>
                                                <td><?php echo $agent->name ?></td>
                                                <td><?php echo $agent->site ?></td>
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