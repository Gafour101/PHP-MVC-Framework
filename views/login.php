<?php
    /** @var model \app\models\User */
    /** @var $this \gaf\phpmvc\View */

$this->title = 'Login';
?>
<h1>Login</h1>
<?php $form = \gaf\phpmvc\form\Form::begin('', "post"); ?>
    
    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>

<?php echo \gaf\phpmvc\form\Form::end(''); ?>