<?php 
if (isset($_GET['p_id'])) {
 $the_post_id=$_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    $post_status = $row['post_status'];
}
if(isset($_POST['Update_Post'])){
    $post_author=$_POST['post_author'];
    $post_title=$_POST['post_title'];
    $post_category_id=$_POST['post_category'];
    $post_status=$_POST['post_status'];
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    $post_content=$_POST['post_content'];
    $post_tags=$_POST['post_tags'];
    move_uploaded_file($post_image_temp,"../images/$post_image");
    $query="UPDATE posts SET ";
    $query .="post_title = '{$post_title}', ";
    $query .="post_category_id = '{$post_category_id}', ";
    $query .="post_date = now(), ";
    $query .="post_author = '{$post_author}', ";
    $query .="post_status = '{$post_status}', ";
    $query .="post_tags = '{$post_tags}', ";
    $query .="post_content = '{$post_content}', ";
    $query .="post_image = '{$post_image}', ";
    $query .="WHERE post_id = '{$post_id}' ";
    $update_post=mysqli_query($connection,$query);
    comfirm($update_post);
    if(! $update_post){
        die("QUERY FILED DD" . mysqli_error($connection));
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <select name="post_category" id="">
            <?php 
 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            comfirm($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title =$row['cat_title'];
                echo "<option value=''>{$cat_title}</option>";
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="title">Pos Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>sg
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control" value="<?php echo $post_content; ?>">
<?php echo $post_content; ?>
  </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="Update_Post" value="Update Post">
    </div>
</form> 