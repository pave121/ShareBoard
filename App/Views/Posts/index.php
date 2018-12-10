<?php require APP_ROOT . '/Views/Inc/header.php'; ?>

<div class="row">
    
   <div class="col-md-6">
       <h1>Posts</h1>
   </div> 
   
   <div class="col-md-6">
       <a href="<?php URL_ROOT; ?>/Posts/add" class="btn btn-primary float-right">
       <i class="fa fa-pencil"></i>Add Post
       </a>
      
   </div>
    
</div>
<?php foreach($data['posts'] as $post) : ?>
    
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2-mb-3">
            Written by: <?php echo $post->name; ?>
            on <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URL_ROOT; ?>/Posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
    
<?php endforeach; ?>

<?php require APP_ROOT . '/Views/Inc/footer.php'; ?>