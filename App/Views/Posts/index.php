<?php require APP_ROOT . '/Views/Inc/header.php'; ?>

<?php flash('post_message'); ?>

<div class="row mb-3">
    
   <div class="col-md-6">
       <h1>Posts</h1>
   </div> 
   
   <div class="col-md-6">
       <a href="<?php echo URL_ROOT; ?>/Posts/add" class="btn btn-primary float-right">
       <i class="fas fa-pencil"></i>Add Post
       </a>
      
   </div>
    
</div>
<?php foreach($data['posts'] as $post) : ?>
    
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            <?php echo $post->name; ?>, 
            <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URL_ROOT; ?>/Posts/show/<?php echo $post->postId; ?>" class="btn btn-dark col-md-3">Full Post</a>
    </div>
    
<?php endforeach; ?>

<?php require APP_ROOT . '/Views/Inc/footer.php'; ?>