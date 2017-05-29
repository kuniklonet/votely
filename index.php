<?php
include_once('php/Login.php');
$Login->start_session();
$Login->check_session();
include_once("includes/head.php");
include_once("includes/nav.php");
include("php/DashboardLoad.php");
if ($_GET['msg'] == "ballotsuccess") {
	?>
    <script type="text/javascript">
        Materialize.toast('The new ballot was successfully added', 10000, 'green lighten-1');
    </script>
	<?php
}
?>
<div class="container" id="dashboard">
	<?php
	$ballots = DashboardLoad::retrieveBallots();
	echo(DashboardLoad::toDashboardMarkup($ballots));
	?>
</div>
<div id="modal1" class="modal bottom-sheet modal-fixed-footer">
	<div class="modal-content">
		<div class="preloader-holder">
			<div class="preloader-wrapper big active">
				<div class="spinner-layer spinner-blue-only">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
<script type="text/javascript">

	$(document).ready(function () {
		$(".button-collapse").sideNav();
		$('.modal').modal();
	});

	function loadModal(id) {
		$.post("php/getModal.php",
			{
				id: id
			},
			function (data, status) {
				updateModal(data);
			});
	}

	function updateModal(markup) {
		$("#modal1").html(markup);
	}

	function submit() {
		// get all input box names and values
		var preferencesExtra = $("#modal1 :input").map(function (index, elm) {
			return {candidateId: elm.name, preference: $(elm).val()};
		});
		var preferences = [];
		for (i = 0; i < preferencesExtra.length; i++) {
			preferences.push(preferencesExtra[i]);
		}
		var ballotId = $("#ballot-id").attr("name");
		var voteDetails = {
			preferences: preferences,
			ballotId: ballotId
		};
		// disable all inputs
		$("#target :input").prop("disabled", true);
		$("#modal-submit-button").addClass("disabled");

		$.post("php/submitVote.php", {data: voteDetails}).done(
			function (data) {
				if (data != "1") {
					//error
					//enable inputs again
					$("#target :input").prop("disabled", false);
					$("#modal-submit-button").removeClass("disabled");
					//display error message
					var message = "null";
					switch (data) {
						case "2":
							message = "Invalid vote";
							break;
						case "3":
							message = "You have already voted on this ballot";
							break;
						case "4":
							message = "You are not a part of this organisation";
							break;
					}
                    Materialize.toast(message, 10000, 'red lighten-1');
				} else {
					//success
					//close modal
					$('#modal1').modal('close');
					//display success message
					refreshDashboard();
					Materialize.toast('Your vote was successful', 10000, 'green lighten-1');
				}
			}
		);

	}
	function refreshDashboard() {
		$("#dashboard").html("");
		//ajax get dashboard markup
		$.post("php/dashboardUpdate.php",
			{data: "refresh"},
			function (data, status) {
				$("#dashboard").html(data);
			});
	}
</script>
</html>
