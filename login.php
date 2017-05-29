<?php
  include_once('php/Login.php');
  $Login->start_session();
  if(isset($_SESSION['username'])){
    header("Location: /");
  }
  include_once("includes/head.php");
  if($_GET["msg"] == "err"){
      ?>
      <script type="text/javascript">
          Materialize.toast('Your login details are incorrect', 60000, 'red lighten-1');
      </script>
    <?php
  }
?>
<nav>
  <div class="nav-wrapper blue">
	<a href="#" class="brand-logo center">Votely</a>
	<ul id="nav-mobile" class="left hide-on-med-and-down">
	</ul>
  </div>
</nav>
  <div class="row">
	<form class="col s12 m8 offset-m2 l6 offset-l3 text-center" action="php/validate.php" method="post">
	  <div class="row">
		<div class="input-field col s12">
		  <i class="material-icons prefix">work</i>
		  <input id="icon_prefix" type="text" class="validate" name ="organisation">
		  <label for="icon_prefix">Organisation</label>
		</div>
	  </div>
	  <div class="row">
		<div class="input-field col s12">
		  <i class="material-icons prefix">account_circle</i>
		  <input id="icon_prefix" type="text" class="validate" name="username">
		  <label for="icon_prefix">Username</label>
		</div>
	  </div>
	  <div class="row">
		<div class="input-field col s12">
		  <i class="material-icons prefix">lock</i>
		  <input id="password" type="password" class="validate" name="password">
		  <label for="password">Password</label>
		</div>
	  </div>
	  <div class="divider"></div>
	  <div class="row">
		<div class="input-field col s6">
		  <input type="checkbox" id="remember-me" class="blue" />
		  <label for="remember-me">Remember me</label>
		</div>
		<div class="input-field col s6">
		  <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action">Login
		  </button>
		</div>
	  </div>
	</form>
  </div>
</body>
</html>
