<?php
/** @var $this \gaf\phpmvc\View */

$this->title = 'Register';

?>
<div class="container d-flex justify-content-center align-items-center " style="margin-top: 0px !important; min-height: 75vh;">

    <div class="card p-4 bg-transparent myborder">
        <div class="text-center">
            <a class="navbar-brand" href="https://github.com/Gafour101"><img src="images/logo.png" alt="Github Profile" style="width: 100%; max-width: 90px;"></a>
            <h1 class="myprimary-color mvc-head  fw-bold lh-1">Create an Account</h1>
        </div>
        
        <?php $form = \gaf\phpmvc\form\Form::begin('', "post"); ?>
        <div class="row">
            <div class="col">
                <?php echo $form->field($model, 'firstname'); ?>
            </div>
            <div class="col">
                <?php echo $form->field($model, 'lastname'); ?>
            </div>
        </div>
        <?php echo $form->field($model, 'email'); ?>
        <div class="row">
            <div class="col-lg-6"><?php echo $form->field($model, 'password')->passwordField(); ?></div>
             <div class="col-lg-6"><?php echo $form->field($model, 'confirmPassword')->passwordField(); ?></div>
        </div>
        <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary myborder-radius my-btn  my-fs-2 w-25 font-monospace" style="color=#0a192f; border: 0px solid transparent">Submit </button>
              </div>

        <?php echo \gaf\phpmvc\form\Form::end(''); ?>
    </div>
</div>
