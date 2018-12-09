<?php require APP_ROOT . '/Views/Inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
          <?php flash('register_success'); ?>
           <center><h2>Login</h2> 
           <p>Please fill in your credentials to log in:</p></center>
           
           <form action="<?php echo URL_ROOT; ?>/Users/login" method="post">
               
                <div class="form-group">
                   <label for="email">Email: </label>
                   <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email'];?>">
                   <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
               </div>
               
                <div class="form-group">
                   <label for="password">Password: </label>
                   <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password'];?>">
                   <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
               </div>
               
               <div class="row">
                   <div class="col">
                       <input type="submit" value= "Login" class="btn btn-success btn-block">
                   </div>
                   <div class="col">
                       <a href="<?php echo URL_ROOT;?>/Users/register" class="btn btn-light btn-block">Don't have an account? Register</a>
                   </div>
               </div>
               
           </form>
           
        </div>
    </div>
</div>

<?php require APP_ROOT . '/Views/Inc/footer.php'; ?>