<?php

if (isset($_POST['creat_post'])) {

    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    //uploid image to images folder

    move_uploaded_file($post_image_temp, "../images/$post_image");
}

?>








<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="title">
    </div>
    <div class="form-group">
        <label for="category">Post Category</label>
        <input type="text" class="form-control" name="post_category_id" id="category">
    </div>
    <div class="form-group">
        <label for="author">Post author</label>
        <input type="text" class="form-control" name="post_author" id="author">
    </div>
    <div class="form-group">
        <label for="status">Post status</label>
        <input type="text" class="form-control" name="post_status" id="status">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name="post_image" id="image">
    </div>
    <div class="form-group">
        <label for="tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags" id="tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="post_content" id="content" rows="10"></textarea>
    </div>
    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="creat_post" value="Publish Post">
    </div>

</form>