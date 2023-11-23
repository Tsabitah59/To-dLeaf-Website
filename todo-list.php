<?php

include 'db.php';

// Proses Insert Data
if(isset($_POST['add'])) {
    $q_insert = "INSERT INTO task(task_label, task_status)VALUE (
        '".$_POST['task']."',
        'open'
    )";

    $run_q_insert = mysqli_query($conn, $q_insert);

    if($run_q_insert) {
        header('Refresh:0; url=todo-list.php');
    }
}

// Show Data
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

if(isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=todo-list.php');
}

// Update Open Close
if(isset($_GET['done'])){
    $status = 'close';
    if($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
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
    <title>Dashboard - To dleaf</title>

    <link rel="stylesheet" href="style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html"><img src="assets/logo.png" alt=""></a>     
        </div>
    </header>

    <section class="satu2nya">
        <div class="sampingan">
            <div class="atas">
                <h3>Welcome!</h3>
                <p>"Focus on the step in front of you, not the whole staircase"</p>
                
                <div class="description">
                    <i class='bx bx-calendar' style="font-size: 20px;"></i>
                    <?= date("l, d M Y")?>
                </div>
            </div>

            <div class="clock">
            <img src="assets/plant (1).png" alt="" class="plant-todo plant-clock">
                <div class="jam2">
                    <div class="kotak">
                        <p id="jam"></p>
                    </div>
                    <div class="kotak">
                        <p id="menit"></p>
                    </div>
                    <div class="kotak">
                        <p id="detik"></p>
                    </div>
                </div>
            </div>

            <div class="bawah">

            </div>

        </div>

        <div class="container">
            <!-- header -->
            <div class="header">
                <img src="assets/plant (2).png" alt="" class="plant-todo">

                <div class="title">
                    <!-- <i class='bx bx-sun'></i> -->
                    <span>My Plan For <?= date("l")?></span>
                </div>
            </div>

            <!-- content -->
            <div class="content">
                <div class="card">
                    <form action="" method="post">
                        <input name="task" type="text" class="input-control" placeholder="Add Task">
                        <button type="submit" name="add"><i class='bx bx-plus'></i></button>
                    </form>
                </div>

                <div class="sheet">
                    <!-- Tugas -->
                    <?php

                    // Memastikan ada data di dalam database
                    if(mysqli_num_rows($run_q_select) > 0) {
                    while($r = mysqli_fetch_array($run_q_select)){
                    ?>

                    <div class="card-todo">
                        <div class="task-item <?= $r['task_status'] == 'close' ? 'done' : ' ' ?>" >
                            <div class="">
                                <input type="checkbox" name="" id="list" onclick="window.location.href = '?done=<?= $r['task_id']?>&status=<?= $r['task_status']?>'" <?= $r['task_status'] == 'close' ? 'checked' : ''?>>
                                <label for="list" class="mark"><?=$r['task_label']?></label for="list">
                            </div>

                            <div>
                                <a href="edit.php?id=<?= $r['task_id']?>"  class="option" title="Edit"><i class='bx bxs-pencil'></i></a>
                                <a href="?delete=<?= $r['task_id']?>" class="option" title="Remove" onclick="confirmDelete(event, <?= $r['task_id']?>)"><i class='bx bxs-trash'></i></a>                                

                            </div>
                        </div>
                    </div>
                    <?php }}else { ?>
                        <div class="pesan">
                            <h6 class="pemberitahuan">All your plan will be displayed here</h6>                        
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </section>
    
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>