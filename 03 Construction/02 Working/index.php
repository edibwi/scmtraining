<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">


		<h1>Blog</h1>
		<hr />

		<div id='main'>

			<?php
				try {

					$pages = new Paginator('1','p');

					$stmt = $db->query('SELECT postID FROM blog_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo ORDER BY postID DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){

							echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
							echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

<<<<<<< HEAD
<<<<<<< HEAD
				$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo ORDER BY postID DESC');
				while($row = $stmt->fetch()){
					
					echo '<div>';
						echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
<<<<<<< HEAD
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
=======
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

							$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
							$stmt2->execute(array(':postID' => $row['postID']));

							$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

							$links = array();
							foreach ($catRow as $cat)
							{
							    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
							}
							echo implode(", ", $links);

						echo '</p>';
>>>>>>> f42cace33f01abcc4a8e57b2a780ff64040e8c26
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';				
					echo '</div>';
=======
								$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
								$stmt2->execute(array(':postID' => $row['postID']));
>>>>>>> 7ee7c7eba5f948eb5718f5c51c6c15f0304f5b11
=======
								$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
								$stmt2->execute(array(':postID' => $row['postID']));
>>>>>>> 56186f5487596b2d8f582950fa49872b48e1f40f

								$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

								$links = array();
								foreach ($catRow as $cat)
								{
								    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
								}
								echo implode(", ", $links);

							echo '</p>';
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';
					}

					echo $pages->page_links();

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>

		</div>

		<div id='sidebar'>
			<?php require('sidebar.php'); ?>
		</div>

		<div id='clear'></div>

	</div>


</body>
</html>