<?php

	session_start();

	include_once('../includes/connection.php');
	include_once('../includes/article.php');

	$article = new Article;

	if(isset($_SESSION['logged_in'])){ 
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = $pdo->prepare('DELETE FROM articles WHERE article_id=?');
			$query->bindValue(1,$id);
			$query->execute();
			$delete='delete.php';
			header('Location:{$delete}');
		}
		$articles=$article->fetch_all();
		?>
		//display delete page
		<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Blog</title>
				<link rel="stylesheet" href="../assets/css/style.css">
			</head>
			<body>
				<div class="container">
						<a href="index.php" id="logo">CMS</a>
						<br/>
						<br/>
						<h3>Select an Article to delete:</h3>
						<form action="delete.php" method="get">
							<select name="id" onchange="this.form.submit();">
								<?php foreach ($articles as $article){ ?>
									<option value="<?php echo $article['article_id'];?>"><?php echo $article['article_title'];?>
								</option>
							<?php } ?>
							</select>

						</form>
				</div>

			</body>
		</html>
		<?php

	}else{
		header('Location:index.php');
	}

?>