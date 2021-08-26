<?php
if (isset($_SESSION['user_role'])) {

    ?>
<?php

    if (isset($_POST['creat_post'])) {

        $post_title = escape($_POST['post_title']);
        $post_author = escape($_POST['post_author']);
        $post_category_id = escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);

        $post_image = escape($_FILES['post_image']['name']);
        $post_image_temp = escape($_FILES['post_image']['tmp_name']);

        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = date('d-m-y');
        $post_comment_count = escape('0');
        $post_views_count = escape('0');

        //uploid image to images folder

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status,post_comment_count,post_views_count) ";
        $query .= "VALUES('{$post_category_id}' , '{$post_title}' , '{$post_author}' , now() , '{$post_image}' , '{$post_content}' ,'{$post_tags}' ,  '{$post_status}' ,'{$post_comment_count}',{$post_views_count})";

        $creat_post_query = mysqli_query($connection, $query);
        confirm($creat_post_query);
        $the_post_id = escape(mysqli_insert_id($connection));
        echo "<p class='bg-success'>Post Created: View <a href='../post.php?p_id={$the_post_id}'>{$post_title}</a><p>";
    }

    ?>








<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" id="title">
  </div>
  <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select name="post_category_id" id="post_category_id" class="form-control">
      <?php
//show categories
    showCategories();
    ?>
    </select>
  </div>
  <div class="form-group">
    <label for="author">Post author</label>
    <select name="post_author" id="author" class="form-control">
      <?php
//show categories
    $query = "SELECT * FROM users ";
    $select_user_query = mysqli_query($connection, $query);
    confirm($select_user_query);
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $username = escape($row['username']);
        $user_id = escape($row['user_id']);
        echo "<option value='{$user_id}'>{$username}</option>";
    }
    ?>
    </select>
  </div>
  <div class="form-group">
    <label for="status">Post status</label>
    <select name="post_status" id="status" class="form-control">
      <option value='published'>Publish</option>
      <option value='draft'>Darft</option>
    </select>
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

    <label for="editor">Post Content</label>
    <textarea name="post_content" id="editor">

    </textarea>

  </div>
  <div class="form-group">

    <input type="submit" class="btn btn-primary" name="creat_post" value="Publish Post">
  </div>

</form>
<?php
} else {
    header("Location: ../index.php");
}
?>