<?php 
/** @var $this \gaf\phpmvc\View 
 *  @var $this \app\models\ContactForm
*/
use gaf\phpmvc\form\TextAreaField;

$this->title = 'Contact';
?>


<h1>Contact us</h1>

<?php $form = \gaf\phpmvc\form\Form::begin('','post'); ?>
  <?php echo $form->field($model, 'subject'); ?>
  <?php echo $form->field($model, 'email'); ?>
  <?php echo new TextAreaField($model, 'body'); ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php \gaf\phpmvc\form\Form::end(); ?>
