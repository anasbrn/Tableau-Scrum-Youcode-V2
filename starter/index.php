<?php 
    include 'scripts.php'  ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>YouCode | Scrum Board</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    



    <!-- ================== END core-css ================== -->
</head>

<body class="bg-light">

    <!-- BEGIN #app -->
    <div id="app" class="app-without-sidebar">
        <!-- BEGIN #content -->
        <div id="content" class="app-content main-style">
            <div class="d-flex justify-content-between align-items-start align-items-lg-center">
                <div>
                    <ol class="breadcrumb h5" style="padding: 0;">
                        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                        <li class="breadcrumb-item active">Scrum Board</li>
                    </ol>
                    <!-- BEGIN page-header -->

                    <!-- END page-header -->
                </div>

                <div class="">
                    <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="resetForm()"> Add Task</a><i class="bx bx-plus"></i>
				</div>
			</div>

			<div class="text-center text-lg-start">
				<h1 class="page-header">
					Scrum Board
				</h1>
			</div>
                <?php if(isset($_SESSION['message'])) : ?>
                    <div class="alert alert-green alert-dismissible fade show">
                        <strong>Success!</strong>
                        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                         ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                    </div>
                <?php endif ?>

                <?php if(isset($_SESSION['message_delete'])) : ?>
                    <div class="alert alert-red alert-dismissible fade show">
                        <strong>Success!</strong>
                        <?php 
                            echo $_SESSION['message_delete']; 
                            unset($_SESSION['message_delete']);
                         ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                    </div>
                <?php endif ?>


                <?php if(isset($_SESSION['add_Task'])) : ?>
                    <div class="alert alert-green alert-dismissible fade show">
                        <strong>Success!</strong>
                        <?php 
                            echo $_SESSION['add_Task']; 
                            unset($_SESSION['add_Task']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                    </div>
                <?php endif ?>
			
			<div class="row"> 
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
					<div class="card mb-5">
						<div class="card-header p-2 bg-dark rounded-top  text-center text-sm-center text-lg-start">
							<h5 class="text-white">To Do (<span id="to-do-tasks-count"><?php countTask(1) ?></span>)</h5>

						</div>
						<div class="to-do-tasks list" data-status="To Do" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
                            <?php getDataToDo(); ?>
                </div>
            </div>
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card mb-5">
                <div class="card-header p-2 bg-dark rounded-top text-center text-sm-center text-lg-start" id="todoCard">
                    <h5 class="text-white">In Progress (<span id="in-progress-tasks-count"><?php countTask(2) ?></span>)</h5>

                </div>
                <div class="list" data-status="In Progress" id="in-progress-tasks">
                    <!-- IN PROGRESS TASKS HERE -->
                        <?php getDataInProgress(); ?>
                </div>
            </div>
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header p-2 bg-dark rounded-top text-center text-sm-center text-lg-start">
                    <h5 class="text-white">Done (<span id="done-tasks-count"><?php countTask(3) ?></span>)</h5>

                </div>
                <div class="list" data-status="Done" id="done-tasks">
                    <!-- DONE TASKS HERE -->
                    <?php getDataDone(); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END #content -->


    <!-- BEGIN scroll-top-btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- END scroll-top-btn -->
    </div>
    </div>


    <!-- Modal Add task-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					
                </div>            
                <div class="modal-body">
                    <form action="scripts.php" method="POST" id="form">
                        <input type="text" class="" hidden name="taskId" id="task-id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="title form-control" id="title" name="title" required>
                        </div>

                        <div>
                            <label class="form-label">Type</label>
                        </div>

                        <div class="p-2">
                            <input class="form-check-input" type="radio" name="type" id="Feature" value="1" required>
                            <label for="Feature">Feature</label>
                        </div>

                        <div class="p-2">
                            <input class="form-check-input" type="radio" name="type" id="Bug" value="2" required>
                            <label for="Bug">Bug</label>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-select" required>
					<option value="">Please select</option>
					<option value="1" id="High">High</option>
					<option value="2" id="Medium">Medium</option>
					<option value="3" id="Low">Low</option>
					</select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
					<option value="">Please select</option>
					<option value="1" id="ToDo">To Do</option>
					<option value="2" id="InProgress">In Progress</option>
					<option value="3" id="Done">Done</option>
					</select>
                        </div>

                        <div class="mb-2">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" id="date" class="form-control" name="date" required>
                        </div>

                        <div>
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5" required></textarea>
                        </div>
                        <div class="modal-footer" id="buttonsModal">
                            <button class="btn btn-secondary col-2" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="add btn btn-primary  col-2" id="saveButton" type="submit" name="save">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>





    <!-- ================== BEGIN core-js ================== -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/app.js"></script>
    <!-- ================== END core-js ================== -->
</body>

</html>