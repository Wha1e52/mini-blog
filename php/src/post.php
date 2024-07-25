<?php
include_once 'classes/Database.php';
include_once 'classes/PostManager.php';
$database = new Database();
$db = $database->getConnection();
$postManager = new PostManager($db);

$id = $_GET['post_id'];
if (isset($id) && is_numeric($id)) {
    $post = $postManager->getPost($id);
    if (!$post) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}
?>
<?php require_once "header.php" ?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= htmlspecialchars($post['img_url']) ?>')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="post-heading">
					<h1><?= $post['title'] ?></h1>
					<h2 class="subheading"><?= htmlspecialchars($post['subtitle']) ?></h2>
					<span class="meta">Posted by
              <a href="#"><?= htmlspecialchars($post['user_name']) ?></a>
              on <?= date('d-m-Y H:i', strtotime($post['created_at'])) ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>
              <?= htmlspecialchars($post['content']) ?>
          </p>
           <hr>
           <div class="clearfix">
          <a class="btn btn-primary float-right" href="make-post.php?prefix=edit&&post_id=<?= ($post['id']) ?>">Edit Post</a>
        </div>
          </div>
      </div>
    </div>
  </article>

  <hr>
<?php require_once "footer.php" ?>