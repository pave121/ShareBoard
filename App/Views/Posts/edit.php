<?php require APP_ROOT . '/Views/Inc/header.php'; ?>
    <a href="<?php echo URL_ROOT; ?>/Posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
        <div class="card card-body bg-light mt-5">
           <center><h2>Edit Post</h2> 
           </center>
           
           <form action="<?php echo URL_ROOT; ?>/Posts/edit/<?php echo $data['id']; ?>" method="post">
               
                <div class="form-group">
                   <label for="title">Title: </label>
                   <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                   <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
               </div>
               
                <div class="form-group">
                   <label for="body">Body: </label>
                    <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                   <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
               </div>
               
               <input type="submit" class="btn btn-success" value="Submit">
           </form>
           
        </div>

<?php require APP_ROOT . '/Views/Inc/footer.php'; ?>