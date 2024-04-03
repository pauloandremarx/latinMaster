<?php
 $message = $this->getFlashModal('message');
 $error = $this->getFlashModal('error');
 $success = $this->getFlashModal('success');   
?>

<script>
	<?php if ( $error) : ?>
		UIkit.modal.dialog('<div class="uk-padding"><h4 class="uk-text-center uk-text-danger uk-text-uppercase"><?php echo $error ?></h4><div class="uk-flex uk-flex-center"><button class="uk-button uk-modal-close salvar-f" type="button">OK</button> </div></div>');
	<?php endif; ?>

	<?php if ( $success ) : ?>
		UIkit.modal.dialog(`
		<div class="uk-padding"><h4 class="uk-text-center text-modal uk-text-uppercase"><?php echo $success ?></h4>
		<div class="uk-padding uk-flex uk-flex-center"><button class="uk-button uk-modal-close salvar-f" type="button">OK</button> </div></div>`);
	<?php endif; ?>

	<?php if ( $message ) : ?>
		UIkit.modal.dialog(`<div class="uk-padding modal-message uk-text-center uk-text-large uk-alert-success"><?php echo $message ?></div>`).show();
	<?php endif; ?>
</script>







