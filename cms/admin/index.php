<?php include('../../php/setup.php');?>
<?php include('../header.php');?>

<?php

session_start();
include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])){
//display index page
?>

<!-- ===== Main content ======------->
<div class="container" style="margin:200px auto;">
    <a href="index.php" id="logo">CMS</a>
    <br/>
    <ol>
        <li><a href="add.php">Add Article</a></li>
        <li><a href="delete.php">Delete Article</a></li>
        <li><a href="edit.php">Edit Article</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>
</div>
<!-- =====End of main content=====---->

    <?php
} else{
    if(isset($_POST['username'],$_POST['password'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if(empty($username) or empty($password))
        {
            $error = 'All fields are required!';
        }
        else{
            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();

            if($num == 1){
                //user entered correct details
                $_SESSION['logged_in'] = true;

            }else
            {
                //user entered false details
                $error="Incorrect details!";
            }

        }
    }
    ?>
<section id="contact" style="background-image:url('../../img/contact.jpg')">
    <div class="container">
        <div class="row margin-top">
            <a href="index.php" id="logo">
                <h3><strong>Login</strong> form</h3>
            </a>
            <div class="contact-form col-md-6 no-padding">
                <form method="post" action="index.php" autocomplete="on">
                    <div class="no-padding">
                        <div class="col-md-6 no-padding">
                            <input id="fullname" type="text" name="username" autocomplete="name" placeholder="Username" />
                        </div>
                        <div class="col-md-6 no-padding">
                            <input id="password" type="password" name="password" placeholder="Password" />
                        </div>
                        <?php if(isset($error)){ ?>
                            <small style="color:#aa0000;"><?php echo $error ?></small>
                        <?php } ?>
                        <div onclick="$(function () {

        $('form').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: 'post.php',
                data: $('form').serialize(),
                success: function () {
                    alert('form was submitted');
                }
            });

        });

    });" class="btn">
                            <span>Login</span>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    <?php
}
?>

<?php include('../footer.php');?>
