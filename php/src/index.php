<?php
include_once 'classes/Database.php';
include_once 'classes/PostManager.php';
$database = new Database();
$db = $database->getConnection();
$postManager = new PostManager($db);
$posts = $postManager->getAllPosts();

if (isset($_GET['do']) && $_GET['do'] == 'delete_post') {
    $post_id_to_delete = $_GET['post_id'];
    $postManager->deletePost($post_id_to_delete);
    header('location: index.php');
    exit;
}
?>

<?php require_once "header.php" ?>

    <!-- Page Header -->
    <header class="masthead"
            style="background-image: url('https://images.unsplash.com/photo-1470092306007-055b6797ca72?ixlib=rb-1.2.1&auto=format&fit=crop&w=668&q=80')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Mini Blog</h1>
                        <span class="subheading">A collection of random musings.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    <?php while ($post = $posts->fetch()): ?>
    <div class="post-preview">
        <a href="post.php?post_id=<?= $post['id'] ?>">
            <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>
            <h3 class="post-subtitle"><?= htmlspecialchars($post['subtitle']) ?></h3>
        </a>
        <p class="post-meta">Posted by
            <a href="#"><?= htmlspecialchars($post['user_name']) ?></a>
            on <?= date('d-m-Y H:i', strtotime($post['created_at'])) ?>
            <a href="?do=delete_post&&post_id=<?= $post['id'] ?>"> ✘</a>
        </p>
    </div>
    <hr>
    <?php endwhile; ?>
    <div class="clearfix">
        <a class="btn btn-primary float-right" href="make-post.php?prefix=new">Create New Post</a>
    </div>
    </div>
    </div>
    </div>
    <hr>
    <?php require_once "footer.php" ?>