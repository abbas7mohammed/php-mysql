<?php
ob_start();

//يجب نبدا بدال السشن
session_start();
//تضمين الملفات
include 'init.php';
if(isset($_SESSION['adminEmail'])){
$qusers = $connect->prepare("SELECT * FROM users");
$qusers->execute();
$numUser = $qusers->rowCount();
$allUsers = $qusers->fetchAll();

$adminEmail = $_SESSION['adminEmail'];


$qposts = $connect->prepare("SELECT * FROM posts");
$qposts->execute();
$numPosts = $qposts->rowCount();
$allPosts = $qposts->fetchAll();

?>





<div>
<h1 class="bg-primary p-1 text-center text-white">Admin Dashboard</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    Users <span class="badge bg-primary"><?php echo $numUser ?></span>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <div class="table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if($numUser>0){
                            foreach($allUsers as $user){
                                echo '<tr>';
                                echo '<th scope="row">' . $user['id'] .'</th>';
                                echo '<td>' . $user['name'] .'</td>';
                                echo '<td>' . $user['email'] .'</td>';
                                echo '<td>';
                                echo '<a href="#"><i class="fa-solid fa-pen-to-square me-2"></i></a>';
                                echo '<a href="#"><i class="fa-solid fa-trash-can"></i></a>';
                                echo '</td>';
                                echo '</tr>';

                            }
                        }else{
                            echo "<div class='alert alert-danger'>Thers is no user</div>";
                        }

                        

                        ?>

                    </tbody>
                    </table>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    Posts <span class="badge bg-primary"><?php echo $numPosts ?></span>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <div class="table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">User</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($numPosts>0){
                            foreach($allPosts as $post){
                                echo '<tr>';
                                echo '<th scope="row">' . $post['id'] .'</th>';
                                echo '<td>' . $post['title'] .'</td>';
                                echo '<td>' . $post['body'] .'</td>';
                                echo '<td>' . $post['user_id'] .'</td>';

                                echo '<td>';
                                echo '<a href="#"><i class="fa-solid fa-pen-to-square me-2"></i></a>';
                                echo '<a href="#"><i class="fa-solid fa-trash-can"></i></a>';
                                echo '</td>';
                                echo '</tr>';

                            }
                        }else{
                            echo "<div class='alert alert-danger'>Thers is no posts</div>";
                        }



                        ?>
                    </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include 'Admin/include/templates/footer.php';

    }else{
        echo "<div class='alerrt alert-danger'> you can not browse directly ... it will rediredct after 5 seconds</div>";
        header('Refresh: 5, url=login.php');
    }
ob_flush();
?>