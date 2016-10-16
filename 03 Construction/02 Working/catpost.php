<?php require('includes/config.php'); 


$stmt = $db->prepare('SELECT catID,catTitle FROM blog_cats WHERE catSlug = :catSlug');
$stmt->execute(array(':catSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['catID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['catTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<p>Posts in <?php echo $row['catTitle'];?></p>
		<hr />
		<p><a href="./">Blog Index</a></p>

<<<<<<< HEAD
<<<<<<< HEAD
		<?php	
		try {

			$stmt = $db->prepare('
				SELECT 
					blog_posts_seo.postID, blog_posts_seo.postTitle, blog_posts_seo.postSlug, blog_posts_seo.postDesc, blog_posts_seo.postDate 
				FROM 
					blog_posts_seo,
					blog_post_cats
				WHERE
					 blog_posts_seo.postID = blog_post_cats.postID
					 AND blog_post_cats.catID = :catID
				ORDER BY 
					postID DESC
				');
			$stmt->execute(array(':catID' => $row['catID']));
			while($row = $stmt->fetch()){
				
				echo '<div>';
					echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
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
					echo '<p>'.$row['postDesc'].'</p>';				
					echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';				
				echo '</div>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

		?>
=======
=======
>>>>>>> 56186f5487596b2d8f582950fa49872b48e1f40f
		<div id='main'>

			<?php	
			try {

				$pages = new Paginator('1','p');

				$stmt = $db->prepare('SELECT blog_posts_seo.postID FROM blog_posts_seo, blog_post_cats WHERE blog_posts_seo.postID = blog_post_cats.postID AND blog_post_cats.catID = :catID');
				$stmt->execute(array(':catID' => $row['catID']));

				//pass number of records to
				$pages->set_total($stmt->rowCount());

				$stmt = $db->prepare('
					SELECT 
						blog_posts_seo.postID, blog_posts_seo.postTitle, blog_posts_seo.postSlug, blog_posts_seo.postDesc, blog_posts_seo.postDate 
					FROM 
						blog_posts_seo,
						blog_post_cats
					WHERE
						 blog_posts_seo.postID = blog_post_cats.postID
						 AND blog_post_cats.catID = :catID
					ORDER BY 
						postID DESC
					'.$pages->get_limit());
				$stmt->execute(array(':catID' => $row['catID']));
				while($row = $stmt->fetch()){
					
					echo '<div>';
						echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
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
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';				
					echo '</div>';

				}

				echo $pages->page_links('c-'.$_GET['id'].'&');

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

			?>

		</div>

		<div id='sidebar'>
			<?php require('sidebar.php'); ?>
		</div>

		<div id='clear'></div>
<<<<<<< HEAD
>>>>>>> 7ee7c7eba5f948eb5718f5c51c6c15f0304f5b11
=======
>>>>>>> 56186f5487596b2d8f582950fa49872b48e1f40f

	</div>


</body>
</html>