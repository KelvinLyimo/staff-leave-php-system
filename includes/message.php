<?php
@session_start();

if(isset($_SESSION['success'])){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Complete! </strong> '.$_SESSION['success'].'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> ';
    unset($_SESSION['success']);
}

if(isset($_SESSION['failed'])){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
               '.$_SESSION['failed'].'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> ';
    unset($_SESSION['failed']);
}

if(isset($_SESSION['warning'])){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning! </strong> '.$_SESSION['warning'].'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> ';
    unset($_SESSION['warning']);
}

if(isset($_SESSION['info'])){
    echo ' <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>Notes! </strong> '.$_SESSION['info'].'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> ';
    unset($_SESSION['info']);
}


