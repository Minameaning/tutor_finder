<?php require ('./templates/header.php'); ?>

<section class="form-container">
    <div class="signup-form-wrapper">
<div class="signup-form-left">
    <img src="./images/signup.png" alt="a woman smile">
</div>
<div class="signup-form-box">
  <div class="signup-form-header">
    <h1>Sign Up</h1>
    <p>create a new account</p><br>
</div>
  <div class="form-wrapper">
  <form method="post" action="save-admin.php">
  <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

  <div class="signup-form-right">
  
            <label for="fname">First Name :</label>
            <input type="text" name="first_name" id="fname" required="" placeholder="Enter your first name"><br>
            <label for="lname">Last Name :</label>
            <input type="text" name="last_name" id="lname" required="" placeholder="Enter your last name"><br>
</div>
<div class="signup-form-right">
<label for="username">Username :</label>
            <input type="text" id="username" name="username" placeholder="Enter your username"><br>
            <label for="password">Password :*</label>
            <input type="password" name="password" id="password" required="" placeholder="Enter your password">
            
            <br><br><br>
</div>
 

<div class="signup-button">
<button class="submit-button" type="submit">Submit</button>
            <button class="cancel-button" type="reset">Cancel</button>
            <br><br>
<p>Have an account? <a href="signin.php">Sign in here</a></p>
</div>
</form>
</div>
</div>
</section>

<?php require ('./templates/footer.php'); ?>