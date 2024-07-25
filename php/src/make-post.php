<?php
include_once 'classes/Database.php';
include_once 'classes/PostManager.php';
$database = new Database();
$db = $database->getConnection();
$postManager = new PostManager($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $user_name = $_POST["user_name"];
    $img_url = $_POST["img_url"];
    $content = $_POST["content"];
    if (isset($_POST['sendPostNew'])) {
        $postManager->createPost($title, $subtitle, $user_name, $img_url, $content);
        header("location: index.php");
        exit;
    } elseif (isset($_POST['sendPostEdit'])) {
        $id = $_POST['sendPostEdit'];
        $postManager->editPost($id, $title, $subtitle, $user_name, $img_url, $content);
        header("location: index.php");
        exit;
    }
}
$prefix = $_GET['prefix'];
if ($prefix == "edit") {
    $post = $postManager->getPost($_GET['post_id']);
}

?>
<?php require_once "header.php" ?>


<style>
    label {
        font-weight: bold;
    }

    .form-control {
        font-size: medium;
    }
</style>


<!-- Page Header -->
<header class="masthead" style="background-image: url('img/edit-bg.jpg')">

    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <?php if ($prefix == "new"): ?>
                    <h1>New Post</h1>
                    <?php elseif ($prefix == "edit"): ?>
                    <h1>Edit Post</h1>
                    <?php endif; ?>
                    <span class="subheading">You're going to make a great blog post!</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="make-post.php" name="sentPost" id="contactForm" method="post">
                <div class="mb-3">
                    <label for="BlogPostTitle" class="form-label">Blog Post Title</label>
                    <input type="text" class="form-control" name="title"
                           value="<?php if($prefix == 'edit'){echo $post['title'];}?>" required>
                </div>
                <div class="mb-3">
                    <label for="Subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="subtitle"
                           value="<?php if($prefix == 'edit'){echo $post['subtitle'];}?>">
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" name="user_name" required
                           value="<?php if($prefix == 'edit'){echo $post['user_name'];}?>">
                </div>
                <div class="mb-3">
                    <label for="BlogImageURL" class="form-label">Blog Image URL</label>
                    <input type="url" class="form-control" name="img_url" required
                           value="<?php if($prefix == 'edit'){echo $post['img_url'];}?>">
                </div>
                <div class="mb-3">
                    <label for="BlogContent" class="form-label">Blog Content</label>
                    <textarea rows="5" class="form-control" name="content" required>
                        <?php if($prefix == 'edit'){echo $post['content'];}?>
                    </textarea>
                </div>

                <br>
                <button type="submit" class="btn btn-primary" id="sendPostButton"
                        name="<?php if($prefix == 'new'){echo 'sendPostNew';}
                        elseif ($prefix == 'edit'){echo 'sendPostEdit';}?>"
                        value="<?php if ($prefix == 'edit'){echo $post['id'];}?>">Submit Post
                </button>
            </form>

        </div>
    </div>
</div>

<?php require_once "footer.php" ?>
