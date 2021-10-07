<?php
include "includes/admin_header.php";
if (isset($_SESSION['user_role'])) {
    ?>

<div id="wrapper">


  <!-- Navigation -->
  <?php include "includes/admin_nav.php";?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome

            <small>
              <?php

    if (empty($_SESSION['username'])) {
        echo "Author";
    } else {
        echo $_SESSION['username'];
    }

    ?>
            </small>

          </h1>


        </div>
      </div>
      <!-- /.row -->
      <?php
if ($_SESSION['user_role'] == 'admin') {

        ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php
if (isset($_GET['post_id'])) {
            $post_id = escape($_GET['post_id']);
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $select_comments = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = escape($row['comment_id']);
                $comment_post_id = escape($row['comment_post_id']);
                $comment_author = escape($row['comment_author']);
                $comment_email = escape($row['comment_email']);
                $comment_status = escape($row['comment_status']);
                $comment_content = escape($row['comment_content']);
                $comment_date = escape($row['comment_date']);

                echo "<tr>";
                echo "<td> $comment_id</td>";
                echo "<td> $comment_author</td>";
                echo "<td> $comment_content</td>";

                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                // $select_categories = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($select_categories)) {
                //     $cat_title = $row['cat_title'];
                //     $cat_id = $row['cat_id'];
                //     echo "<td> $cat_title</td>";
                // }

                echo "<td> $comment_email</td>";
                echo "<td> $comment_status</td>";
                $post_query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                $select_post = mysqli_query($connection, $post_query);
                while ($row = mysqli_fetch_assoc($select_post)) {
                    $post_title = escape($row['post_title']);
                    echo "<td> <a href='../post.php?p_id={$comment_post_id}' target='_blank'>$post_title</a></td>";
                }

                echo "<td> $comment_date</td>";
                echo "<td><a href='post_comments.php?approve=$comment_id&post_id=$post_id'>Approve</a></td>";
                echo "<td><a href='post_comments.php?unapprove=$comment_id&post_id=$post_id'>Unapprove</a></td>";
                echo "<td><a href='post_comments.php?delete=$comment_id&post_id=$post_id'>Delete</a></td>";

                echo "</tr>";
            }
            ?>
          <?php

// unapprove comments
            if (isset($_GET['unapprove'])) {
                $the_comment_id = escape($_GET['unapprove']);

                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";

                $unapprove_comment_query = mysqli_query($connection, $query);
                // refraiche the page , to show data after unapproving a comment
                header("Location: post_comments.php?post_id=$post_id");
                confirm($unapprove_comment_query);
            }
// approve comments
            if (isset($_GET['approve'])) {
                $the_comment_id = escape($_GET['approve']);

                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";

                $approve_comment_query = mysqli_query($connection, $query);
                // refraiche the page , to show data after approving a comment
                header("Location: post_comments.php?post_id=$post_id");
                confirm($approve_comment_query);
            }

// delete comment from db

            if (isset($_GET['delete'])) {

                $the_comment_id = escape($_GET['delete']);

                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

                $delete_comment_query = mysqli_query($connection, $query);

                // refraiche the page , to show data after deleting a comment
                header("Location: post_comments.php?post_id=$post_id");

                confirm($delete_commment_query);
            }
            ?>
        </tbody>
      </table>
      <?php
}
    }
} else {
    header("Location: ../index.php");
}
?>

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>