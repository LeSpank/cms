<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/nav.php";?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php
if (isset($_GET['p_author'])) {
    $p_author = escape($_GET['p_author']);
    $query = "SELECT * FROM posts WHERE post_author = '{$p_author}' ORDER BY post_id DESC";

    $select_all_posts_querys = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts_querys)) {
        $post_title = escape($row['post_title']);
        $post_id = escape($row['post_id']);
        $post_author = escape($row['post_author']);
        $post_date = escape($row['post_date']);
        $post_image = escape($row['post_image']);
        $post_status = escape($row['post_status']);
        $post_content = escape(substr($row['post_content'], 0, 400));

        if ($post_status == 'published') {

            ?>
      <h1 class="page-header">
        Page Heading
        <small>Secondary Text</small>
      </h1>



      <!-- First Blog Post -->



      <h2>
        <a href="post.php?p_id=<?php echo $post_id;
            ?>"><?php echo $post_title;
            ?></a>
      </h2>
      <p class="lead">
        <?php
//selecting post author from db

            $query = "SELECT * FROM users WHERE user_id = $post_author";
            $select_user_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_user_query)) {

                $post_author = escape($row['user_firstname'] . " " . $row['user_lastname']);

            }
            ?>

        All Posts By <?php echo $post_author; ?>
      </p>
      <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
      <hr>
      <a href="post.php?p_id=<?php echo $post_id;
            ?>">
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
      </a>
      <hr>
      <p><?php echo $post_content; ?></p>
      <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
          class="glyphicon glyphicon-chevron-right"></span></a>
      <?php }}}?>



    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "includes/sidebar.php";?>
  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php";?>