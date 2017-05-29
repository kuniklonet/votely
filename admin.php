<?php
include("php/Login.php");
Login::check_session();
include("includes/head.php");
include("includes/nav.php");
$message = "";
$colour = "";
switch ($_GET["msg"]) {
	case 1:
		$message = "User successfully added";
		$colour = "green lighten-1";
		break;
	case 2:
		$message = "Username already exists within organisation";
        $colour = "red lighten-1";
		break;
	case 3:
		$message = "Organisation does not exist";
        $colour = "red lighten-1";
		break;
	case 4:
		$message = "Unknown error";
        $colour = "red lighten-1";
		break;
}
if (isset($_GET["msg"])) {
	?>
    <script type="text/javascript">
        Materialize.toast('<?php echo $message; ?>', 60000, '<?php echo $colour; ?>');
    </script>
	<?php
}
?>
<div class="container">
    <br>


    <h3>Create a new ballot</h3>
    <form class="col s12" action="admin/addBallot.php" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="ballot-name" name="name" type="text" class="validate">
                <label for="ballot-name">Ballot Name</label>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="description" name="description" class="materialize-textarea"></textarea>
                    <label for="description">Ballot Description</label>
                </div>
            </div>
        </div>

        <div id="candidates">
            <div class="row">
                <div class="input-field col s5">
                    <button type="button" class="btn waves-effect waves-light blue" onclick="addCandidate()">+ Candidate</button>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input name="candidate[]" type="text" class="validate" placeholder="Candidate Name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col">
                <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>

    <div class="divider"></div>

    <h3>Add a new user</h3>
    <div class="row">
        <form class="col s12" action="admin/addUser.php" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="A unique username within the organisation" id="first_name" name="username"
                           type="text" class="validate">
                    <label for="first_name">Username</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s5">
                    <button type="button" class="btn waves-effect waves-light blue" onclick="generate()">Generate
                        <i class="material-icons right">vpn_key</i>
                    </button>
                </div>
                <div class="input-field col s7">
                    <input placeholder="Click GENERATE for a random password" id="password" type="text" name="password"
                           class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" placeholder="Optional">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col">
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function () {
        $(".button-collapse").sideNav();
    });

    function generate() {
        const passwordLength = 8;
        const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        var password = "";
        for (var i = 0; i < passwordLength; i++) {
            password += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById("password").value = password;
    }

    function addCandidate(){
        var markup = "<div class='row'>";
        markup += "<div class='input-field col s12'>";
        markup += "<input name='candidate[]' type='text' class='validate' placeholder='Candidate Name'>";
        markup += "</div></div></div>";

        $("#candidates").append(markup);
    }
</script>
</html>
