<?php if(!empty($errors)) : ?>
  <div id=error class="animated fadeInDown delay-02s">

    <?php foreach($errors as $error) : ?>

      <p><?php echo $error; ?></p>

    <?php endforeach ?>

  </div>
<?php endif ?>
<?php //ob_end_flush() ?>
