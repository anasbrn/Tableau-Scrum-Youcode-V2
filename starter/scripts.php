<?php
    include 'database.php' ;

    session_start();

    if(isset($_POST['save'])) createTask();
    if(isset($_POST['delete'])) deleteTask();
    if(isset($_POST['update'])) updateTask();

function getDataToDo(){
        $connection = $GLOBALS['connection'];
        $query = "SELECT tasks.id, tasks.title, tasks.type_id, tasks.priority_id, tasks.status_id, tasks.task_datetime, tasks.description, types.nameType, statuses.nameStatuses, priorities.namePriority FROM `tasks` JOIN priorities ON tasks.priority_id = priorities.id JOIN types ON tasks.type_id = types.id JOIN statuses ON tasks.status_id = statuses.id ";
        $result = mysqli_query($connection, $query) ;
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($row['status_id']==1){
            ?>
            <button class="d-flex button w-100 border p-1" onclick="editTask(this)" id="<?php echo $row['id'] ; ?>" >
                <div class="col-1">
                    <i class="bi bi-question-circle text-danger"></i> 
                </div>
                <div class="col-11 text-start">
                    <div class="d-flex">
                        <div class="fw-bold" id="buttonTitle"><?php echo $row['title'] ; ?></div>
                    </div>
                    <div class="float-container">
                        <div class="text-muted d-flex">#<?php echo $row['id'] ; ?> created in <div style="margin-left : 5px" id="buttonDate"><?php echo $row['task_datetime'] ?></div></div>
                        <div class="description" id="buttonDescription"><?php echo $row['description'] ?></div>
                    </div>
                    <div class="">
                        <span class="col-2 btn btn-primary btn-sm rounded-pill p-0" id="buttonPriority"><?php echo $row['namePriority'] ?></span>
                        <span class=" col-2 btn btn-sm rounded-pill text-white p-0 btn-gray-400" id="buttonType"><?php echo $row['nameType'] ?></span>   
                    </div>
                </div>
                <p id="buttonStatus" hidden>To Do</p>
            </button>
                <?php
                }
            }
        }                
}

function getDataInProgress(){
    global $connection;
    $query = "SELECT tasks.id, tasks.title, tasks.type_id, tasks.priority_id, tasks.status_id, tasks.task_datetime, tasks.description, types.nameType, statuses.nameStatuses, priorities.namePriority FROM `tasks` JOIN priorities ON tasks.priority_id = priorities.id JOIN types ON tasks.type_id = types.id JOIN statuses ON tasks.status_id = statuses.id ";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['status_id'] == 2){
                ?>
                <button draggable="true" class="d-flex button w-100 border p-1" onclick="editTask(this)" id="<?php echo $row['id'] ; ?>">
                    <div class="col-1">
                        <i class="spinner-border spinner-border-sm text-warning"></i> 
                    </div>
                    <div class="col-11 text-start">
                    <div class="fw-bold" id="buttonTitle"><?php echo $row['title'] ; ?></div>
                        <div class="float-container">
                            <div class="text-muted d-flex">#<?php echo $row['id'] ?> created in <div style="margin-left : 5px" id="buttonDate"><?php echo $row['task_datetime'] ?></div></div>
                            <div class="description" id="buttonDescription"><?php echo $row['description'] ?></div>
                        </div>
                        <div class="">
                            <span class="col-2 btn btn-primary btn-sm rounded-pill p-0" id="buttonPriority"><?php echo $row['namePriority'] ?></span>
                            <span class=" col-2 btn btn-sm rounded-pill text-white p-0 btn-gray-400" id="buttonType"><?php echo $row['nameType'] ?></span>
                        </div>
                    </div>
                    <p id="buttonStatus" hidden>In Progress</p>
                </button>
                <?php
            }
        }
    }
}

function getDataDone(){
    global $connection;
    $query = "SELECT tasks.id, tasks.title, tasks.type_id, tasks.priority_id, tasks.status_id, tasks.task_datetime, tasks.description, types.nameType, statuses.nameStatuses, priorities.namePriority FROM `tasks` JOIN priorities ON tasks.priority_id = priorities.id JOIN types ON tasks.type_id = types.id JOIN statuses ON tasks.status_id = statuses.id ";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['status_id'] == 3){
                ?>
                <button class="d-flex button w-100 border p-1" onclick="editTask(this)" id="<?php echo $row['id'] ; ?>">
                    <div class="col-1">
                        <i class="bi bi-check-circle text-success"></i> 
                    </div>
                    <div class="col-11 text-start">
                    <div class="fw-bold" id="buttonTitle"><?php echo $row['title'] ; ?></div>
                        <div class="float-container">
                            <div class="text-muted d-flex">#<?php echo $row['id'] ?> created in <div style="margin-left : 5px" id="buttonDate"><?php echo $row['task_datetime'] ?></div></div>
                            <div class="description" id="buttonDescription"><?php echo $row['description'] ?></div>
                        </div>
                        <div class="">
                            <span class="col-2 btn btn-primary btn-sm rounded-pill p-0" id="buttonPriority"><?php echo $row['namePriority'] ?></span>
                            <span class=" col-2 btn btn-sm rounded-pill text-white p-0 btn-gray-400" id="buttonType"><?php echo $row['nameType'] ?></span>
                        </div>
                    <p id="buttonStatus" hidden>Done</p>
                </button>
                    <?php
            }
        }
    }
}

function createTask(){
    global $connection; 
    
    $title          = $_POST['title'];
    $type           = $_POST['type'];
    $priority       = $_POST['priority'];
    $status         = $_POST['status'];
    $date           = $_POST['date'];
    $description    = $_POST['description'];

    $sql = "INSERT INTO tasks values (null, '$title', $type, $priority, $status, '$date', '$description')";   
    $result = mysqli_query($connection, $sql) ;

    if($result) {
        $_SESSION['add_Task'] = "Task added successfully" ;
        header ('location:index.php');
    }
    else {
        echo "Failed!" ;
    }    
}

function countTask($id){
    global $connection;
    $request = "SELECT COUNT(id) AS countTasks FROM tasks WHERE status_id=$id ";
    $result = mysqli_query($connection, $request) ;
    $data = mysqli_fetch_assoc($result) ;
    echo $data['countTasks'] ;
}

function updateTask(){

    global $connection;
    $id=$_POST['taskId'];
    $title=$_POST['title'];
    $priority=$_POST['priority'];
    $status=$_POST['status'];
    $type=$_POST['type'];
    $date=$_POST['date'];
    $description=$_POST['description'];
    
    $sql = "UPDATE `tasks` SET `title`='$title',`type_id`=$type,`priority_id`=$priority,`status_id`=$status,`task_datetime`='$date',`description`='$description' WHERE `id`=$id";
    if (empty($title) || empty($priority) || empty($status) || empty($type) || empty($date) || empty($description))
    {
    $_SESSION['fieldMessage'] = "Please fill all the fields" ;
    header('location: index.php') ;
    }

    else {
        $result = mysqli_query($connection, $sql);
        $_SESSION['message'] = "Update successfully" ;
        header('location: index.php');
    }
    
    
    

}

function deleteTask(){
    global $connection;
    $id=$_POST['taskId'];
    $sql = "DELETE FROM `tasks` WHERE `id`=$id";
    $result = mysqli_query($connection, $sql);

    if($result){
        $_SESSION['message_delete'] = "Delete successfully" ;
        header('location: index.php');
    }

}

?>






