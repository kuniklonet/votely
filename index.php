<?php
include_once('php/Login.php');
$Login->start_session();
$Login->check_session();
include_once("includes/head.php");
include_once("includes/nav.php");
  ?>
  <div class="container">
    <ul class="collection">

      <li class="collection-item avatar">
        <i class="material-icons circle blue">grade</i>
        <span class="title">President</span>
        <p>This ballot is open for voting.</p>
        <a href="#modal1"class="secondary-content btn-floating btn-large red" onclick="loadModal('1234')">
          <i class="large material-icons">subject</i>
        </a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle orange">lock</i>
        <span class="title">Vice President</span>
        <p>This ballot is not yet open.</p>
        <a href="#modalload"class="secondary-content btn-floating btn-large red" onclick="loadModal('1234')">
          <i class="large material-icons">subject</i>
        </a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle green">done</i>
        <span class="title">Secretary</span>
        <p>You have successfully voted on this ballot.</p>
        <a href="#modalload"class="secondary-content btn-floating btn-large red" onclick="loadModal('1234')">
          <i class="large material-icons">subject</i>
        </a>
      </li>

      <li class="collection-item avatar">
        <i class="material-icons circle green">done</i>
        <span class="title">Treasurer</span>
        <p>You have successfully voted on this ballot.</p>
        <a href="#modalload"class="secondary-content btn-floating btn-large red" onclick="loadModal('1234')">
          <i class="large material-icons">subject</i>
        </a>
      </li>
    </ul>
  </div>

  <div id="modal1" class="modal bottom-sheet modal-fixed-footer">
    <div class="modal-content">
      <h3>President</h3>
      <p>This is the ballot description</p>
      <ul class="collection with-header">
        <li class="collection-header"><h4>Candidates</h4></li>
        <li class="collection-item">
          Mark
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          David
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          Andrew
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          Sarah
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          Jess
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          Kate
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
        <li class="collection-item">
          Daniel
          <div class="input-field inline">
            <input id="4321" type="number" class="validate preference" placeholder="Preference">
          </div>
        </li>
      </ul>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn col s4"><i class="material-icons right">send</i>Cast Vote</a>
    </div>
  </div>

  <!-- Modal With Preloader -->
  <div id="modalload" class="modal bottom-sheet">
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
      //AJAX here
      console.log(id);
    }
  </script>
</html>
