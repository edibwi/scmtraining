<?php require('includes/config.php'); 



$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts_seo WHERE postSlug = :postSlug');
$stmt->execute(array(':postSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>

		<div id='main'>

			<?php	
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

						$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
						$stmt2->execute(array(':postID' => $row['postID']));

						$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

<<<<<<< HEAD
		<?php	
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
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
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
		?>
		<div id='disqus_thread'></div>
		<script type='text/javascript'>
		  /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		  var disqus_shortname = 'scmblog2016'; // required: replace example with your forum shortname
			  (function() {
			  var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			  dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			  (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		  })();
		</script>
=======
						$links = array();
						foreach ($catRow as $cat)
						{
						    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
						}
						echo implode(", ", $links);

					echo '</p>';
					echo '<p>'.$row['postCont'].'</p>';				
				echo '</div>';
			?>

		</div>

		<div id='sidebar'>
			<?php require('sidebar.php'); ?>
		</div>

		<div id='clear'></div>
>>>>>>> 7ee7c7eba5f948eb5718f5c51c6c15f0304f5b11

	</div>


</body>
</html>