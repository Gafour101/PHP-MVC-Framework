<?php

/**
 * @var $exception \Exception
 */
?>
<div class="container">
    <div class=" mt-md-5 text-center">
            <h1 class="myprimary-color mvc-head m-lg-2 mt-0 my-fs-6 fw-bold lh-1"><?php echo $exception->getCode(); ?> - <?php echo $exception->getMessage(); ?></h1>
            <img class="img-fluid mvc-image" style="align:center; max-width: auto; width:80% position:absolute; bottom:0; right: 0;" src="/images/404.svg" alt="">
    </div>
</div>
