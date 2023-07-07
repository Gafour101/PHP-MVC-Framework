<?php 
/** @var $this \gaf\phpmvc\View */

  use gaf\phpmvc\Application; 
  // echo '<pre>';
  // var_dump($title);
  // echo '</pre>';
  // exit;

$this->title = 'Dashboard';
?>

<div class="container">
  <div class="row mr-auto">
    <div class="col-lg-6">
      <div class="align-left">
        <p class="myprimary-color my-fs-2 mb-0 font-monospace">&nbsp;Welcome</p>
        <h1 class="mysecondary-color mvc-head m-lg-2 mt-0 my-fs-6 fw-bold lh-1"><?php echo Application::$app->user->getDisplayName(); ?></h1>
        <div class=" mt-4">
            <p class="m-lg-2 mytext-color fs-5">This PHP MVC Framework with Login and Register Authentication project is a versatile web development framework that incorporates a Model-View-Controller (MVC) architectural pattern. </p>
            <br>
            <p class="m-lg-2 mytertiary-color fs-5 font-monospace">Programming Languages and Tools used: </p>
            <img src="/images/tools.svg" style=" max-width: auto; width:90%" alt="">
        </div>
      </div>
    </div>
    <div class="p-lg-3 col-lg-6 text-center" style="margin-right: auto;">
      <img class="img-fluid mvc-image" style="align:center; max-width: auto; width:90%" src="/images/mvc.svg" alt="">
    </div>
  </div>
  
</div>
