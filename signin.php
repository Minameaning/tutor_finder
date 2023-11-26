<?php require ('./templates/header.php'); ?>
<section class="form-container">
    <div class="info-box">
        <div class="signin-wrapper">
    <h1>Sign In</h1>
    <p>sign in below</p><br>
    <form method="post" action="validate.php">
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username" placeholder="Enter your username"><br>
            <label for="password">Password: </label><br>
            <input type="password" name="password" id="password" required="" placeholder="Enter your password"><br>
        
              <br>
              <div class="signin-button">
            <button class="submit-button" type="submit"><a href="review.php"></a>Submit</button>
            <button class="cancel-button" type="submit"><a href="signin.php"></a>Cancel</button>
            <br><br><p>Not registered? <a href="signup.php">create an account</a></p>
            </div>
        </form>
  </div>

  <div class="form-right">
    <img src="./images/learning.png" alt="a stident prepared for study">
    
  </div>
</section>



<?php require ('./templates/footer.php'); ?>