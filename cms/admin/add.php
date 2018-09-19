<?php

session_start();

include_once('../header.php');
include_once("../includes/connection.php");

if(isset($_SESSION['logged_in'])){
    if(isset($_POST['title'],$_POST['content'])){
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        if(empty($title) or empty($content))
        {
            $error='All fields are required!';
        }else{
            $query = $pdo->prepare("SELECT * FROM articles");
            $query->execute();
            $n = $query->rowCount();
            $query = $pdo->prepare('INSERT INTO articles (article_id,article_title,article_content,article_timestamp) VALUES (?,?,?,?) ');
            $query->bindValue(1,$n+1);
            $query->bindValue(2,$title);
            $query->bindValue(3,$content);
            $query->bindValue(4,time());
            $query->execute();
            $error = 'Article added sucessfully.';
        }
    }
    ?>
    <div class="container" style="margin-top:250px; margin: auto;">
        <a href="index.php" id="logo">CMS</a>
        <br/>
        <br/>
        <h3 style="color:#000;">Add Article</h3>
        <br/>
        <form action="add.php" method="post" autocomplete="off">

            <input type="text" name="title" placeholder="Title"/>
            <br/>
            <br/>
            <textarea rows="15" cols="50" name="content" placeholder="Content">
							</textarea>
            <br/>
            <?php if(isset($error)){ ?>
                <small style="color:#aa0000;"><?php echo $error ?></small>
            <?php } ?>
            <br/>
            <input type="submit" value="Add Article"/>
        </form>

    </div>

    <?php
}
include_once('../footer.php');
?>

