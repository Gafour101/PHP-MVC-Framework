<?php
    /** @var model \app\models\User */
    /** @var $this \gaf\phpmvc\View */

$this->title = 'Login';
?>

<div class="container d-flex justify-content-center align-items-center " style="margin-top: 0px !important; min-height: 80vh;">

    <div class="card p-4 bg-transparent myborder w-50">
        <div class="text-center">
            <a class="navbar-brand" href="https://github.com/Gafour101"><img src="images/logo.png" alt="Github Profile" style="width: 100%; max-width: 90px;"></a>
            <h1 class="myprimary-color mvc-head  fw-bold lh-1">Login</h1>
        </div>
        
        <?php $form = \gaf\phpmvc\form\Form::begin('', "post"); ?>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <button type="submit" class="btn btn-primary myborder-radius my-btn  my-fs-2 w-25 font-monospace" style="color=#0a192f; border: 0px solid transparent">Submit </button>
        <?php echo \gaf\phpmvc\form\Form::end(''); ?>
    </div>
</div>