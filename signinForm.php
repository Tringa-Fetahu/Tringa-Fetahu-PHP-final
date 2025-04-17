
<?php
  include_once 'header.php';
?>

<style>
    body {
      background-color: #121212;
      color: #f0f0f0;
    }

	h1{
		margin-left:95px;

	}
	.col-4{
		margin-left:155px;
	}
</style>
<h1>Login</h1>

  <div class="container">
    <div class="col-4"></div>
    <div class="col-4">
      <form action="signinLogic.php" method="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>

      <p>If you are not registered, sign up <a href="signupForm.php">here</a></p>

    </div>
    <div class="col-4"></div>
  </div>



<?php
  include_once 'footer.php';
?>
