<?php require APP_ROOT . '/Views/Inc/header.php'; ?>

<a href="<?php echo URL_ROOT; ?>/Posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>

<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    By: <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>

<p><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id==$_SESSION['user_id']) :?>
<div class="row mb-3">
    <div class="col-md-6">
       <a href="<?php echo URL_ROOT; ?>/Posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
    </div>
    <div class="col-md-6">
       <form action="<?php echo URL_ROOT; ?>/Posts/delete/<?php echo $data['post']->id; ?>" method="post">
           <input type="submit" value="Delete" class="btn btn-danger float-right">
       </form>
    </div>
</div>
<?php endif; ?>
<?php require APP_ROOT . '/Views/Inc/footer.php'; ?>