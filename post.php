<?php include 'inc/header.php'; ?>


<?php 
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("Location: 404.php");
	} else {
		$id = $_GET['id'];
	}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">

			<?php 
				$query = "SELECT * FROM tbl_post WHERE id = $id";
				$post = $db->select($query);
       			if ($post) {
            	while ($result = $post->fetch_assoc()) {
			?>

			<h2><?php echo $result['title'];?></h2>
			<h4><?php echo $fm->formatDate($result['date'])?>, By <?php echo $result['author']?></h4>
			<img src="admin/upload/<?php echo $result['image'];?>" alt="MyImage"/>
			<?php echo $result['body'];?>


			<div class="relatedpost clear">
				<h2>Related articles</h2>

				<?php

					$catid = $result['cat'];
					$catquery = "SELECT * FROM tbl_post WHERE cat = $catid order by rand() limit 6";
					$catpost = $db->select($catquery);
					if ($catpost) {
						while ($catresult = $catpost->fetch_assoc()) {
				?>

                <a href="post.php?id=<?php echo $catresult['id']; ?>">
                    <img src="admin/upload/<?php echo $catresult['image'];?>" alt="MyImage"/>
                </a>
				<?php } } else { echo "No Releted Post Available";} ?>
			</div>
            <?php } } else { header("Location:404.php");}?>
		</div>

	</div>
<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>


    


