<?php
ob_start();
session_start();

//نعمل هذا الشرط لكي لا يرجع الى صفحة تسجيل الدخول بعد ان يتم الدخول الى صفحة اندكس
if(isset($_SESSION['adminID'])){
    header('Location:index.php');
    exit();
}



include 'init.php';

// check if user login

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $connect->prepare("SELECT * FROM users WHERE email=? and password=?");
        $stmt->execute(array($email,$password));
        $result = $stmt->rowCount();
        $adminAccount = $stmt->fetch();
        if($result>0){
            $_SESSION['adminID'] = $adminAccount['id'];
            $_SESSION['adminEmail'] = $adminAccount['email'];
            

        }else{
            echo "<h3 class='bg-secondary'>there is no user exist</h3>";   
        }
    }
}







?>
<div class="Admin-login">
<h1 class="bg-primary p-1 text-center text-white">Admin Login</h1>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="Admin-login--form">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
                <div id="emailHelp" class="form-text">write an ideal email</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="off">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>









<?php

include 'Admin/include/templates/footer.php';

ob_flush();
?>