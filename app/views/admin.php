<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
 
<div class="uk-container uk-margin-large-top" uk-height-viewport="expand:true; min-height: 500">
  <h2 class="uk-text-center">
    Bem-vindo ao Dashboard
  </h2>
  <div class="uk-margin">
    <a class="uk-card uk-card-default uk-card-body uk-card-hover" href="<?= $this->path_for('slider') ?>">
      <h3 class="uk-card-title">
        Cadastro de Banner 
        <span uk-icon="icon: image"></span>
      </h3>
      <p>
        Área destinada ao cadastro de banners promocionais do site.
      </p>
    </a>
  </div>
  <div class="uk-margin">
    <a class="uk-card uk-card-default uk-card-body uk-card-hover" href="<?= $this->path_for('post') ?>">
      <h3 class="uk-card-title">
        Cadastro de Post Blog 
        <span uk-icon="icon: file-text"></span>
      </h3>
      <p>
        Seção para adicionar novos posts ao blog, compartilhando notícias e atualizações.
      </p>
    </a>
  </div>
</div>
 
<?= $this->stop() ?>
<?= $this->start('javascript_footer') ?>
<script src="<?= $this->base_path()  ?>js/validateForm.js"></script>
<?= $this->stop() ?>

