<?php 
/** @var $this \gaf\phpmvc\View 
 *  @var $this \app\models\ContactForm
*/
use gaf\phpmvc\form\TextAreaField;

$this->title = 'Contact';
?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
          <h1 class="myprimary-color mvc-head m-lg-2 mt-0 my-fs-6 fw-bold lh-1">Contact Us</h1>
          <div class="">
            <div class=" myborder-radius p-4 w-100">
              <?php $form = \gaf\phpmvc\form\Form::begin('','post'); ?>
              <div class="row">
                  <div class="col-lg-6"><?php echo $form->field($model, 'subject'); ?></div>
                  <div class="col-lg-6"><?php echo $form->field($model, 'email'); ?></div>
              </div>
              
              
              <?php echo new TextAreaField($model, 'body'); ?>
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary myborder-radius my-btn  my-fs-3 "><b>Submit</b> </button>
              </div>
              
              <?php \gaf\phpmvc\form\Form::end(); ?>
            </div>
          </div>
    </div>
    <div class="col-lg-6">
      <img class="img-fluid mvc-image" style="align:center; max-width: auto; width:80% position:absolute; bottom:0; right: 0;" src="/images/contact.svg" alt="">
    </div>
  </div>
  
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                if (input.value !== '') {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                }
            });
        });
    });
</script>
