<?php

include 'db.php';

// Select data yang di Edit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);

$d = mysqli_fetch_object($run_q_select);

// Update Data
if(isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_label ='".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    
    header('Refresh:0; url=todo-list.php');
}

?>



<!-- Tugas -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plan - To dLeaf</title>

    <link rel="stylesheet" href="style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<header>
        <div class="logo">
            <img src="assets/logo.png" alt="">       
        </div>
    </header>

    <section class="edit-taskmu">
        <div class="container edit-task-pls">
        <!-- header -->
            <div class="header edit-header">
            <img src="assets/plant (2).png" alt="" class="plant-todo">

            <div class="title">
                <!-- <i class='bx bx-sun'></i> -->
                <span>Edit Your Plan</span>
            </div>
        </div>

        <!-- content -->
        <div class="content edit-content">
            <div class="card edit-card">
                <form action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Edit Plan" value="<?= $d->task_label?>">
                    <div class="text-right">
                        <button type="submit" name="edit"><i class='bx bxs-pencil' ></i></button>
                    </div>
                </form>
            </div>
            <div class="sheet edit-sheet">
                <a href="todo-list.php" class="button btn-back">Go Back</a>
            </div>
        </div>
    </div>
    </section>
    
</body>
</html>