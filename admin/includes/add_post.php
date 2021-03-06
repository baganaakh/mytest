<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
 move_uploaded_file($post_image_temp, "../images/$post_image");

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
   
    $query = "INSERT INTO `posts`(`post_title`, `post_author`, `post_category_id`, `post_status`, `post_image`, `post_content`, `post_tags`, `post_date`)";
    $query .= " VALUES ('$post_title','$post_author','$post_category_id','$post_status','$post_image','$post_content','$post_tags',NOW())";
  $post_post=mysqli_query($connection, $query);
  comfirm($post_post);
 $the_post_id= mysqli_insert_id($connection);
  echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or 
  <a href='posts.php'>Edit More Posts</a></p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="post_category_id">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            comfirm($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title =$row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post status</option>
            <option value="published">Published</option>
             <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" cols="30" rows="10" class="form-control" id="body">
            

  </textarea>
  <script >
ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form> 