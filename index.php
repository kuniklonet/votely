<?php
include_once('php/Login.php');
$Login->start_session();
$Login->check_session();
include_once("includes/head.php");
include_once("includes/nav.php");
include("php/DashboardLoad.php");
?>
  <div class="container">
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
    $( document ).ready(function(){
      $(".button-collapse").sideNav();
      $('.modal').modal();
    })

    function loadModal(id){
      $.post("php/getModal.php",
      {
        id: id
      },
      function(data, status){
        updateModal(data);
      });
    }

    function updateModal(markup){
      $("#modal1").html(markup);
    }
  </script>
</html>
