<!DOCTYPE html>
<html>
  <head>
    <?php $this->insert('layouts/pixel_tag_part_1') ?>
    <?php $this->insert('layouts/header') ?>
    <?php echo $this->section('javascript_header'); ?>
  </head>
  <body class="overflow_x_hidden uk-animation-fade" onbeforeunload="ConfirmClose()" onunload="HandleOnClose()">

    <?php $this->insert('layouts/pixel_tag_part_2') ?>
    <?php $this->insert('layouts/navigation') ?>
      
    <?php echo $this->section('mainContent'); ?>
    <?php $this->insert('layouts/footer') ?>
    <?php echo $this->section('javascript_footer'); ?>

    <?php $this->insert('components/notifications') ?>
  </body>

</html>

