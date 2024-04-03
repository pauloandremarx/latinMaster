<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
<section class="uk-container uk-margin-large-top" uk-height-viewport="expand: true">
   <ul class="uk-breadcrumb">
      <li>
         <a href="<?= $this->path_for('admin') ?>  ">
            Admin
         </a>
      </li>
      <li>
         <span>
            Todos Banners
         </span>
      </li>
   </ul>
   <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-large-top">
      <h2>
         Todos Banners
      </h2>
      <a href="<?= $this->path_for('slider.create') ?> " class="uk-button uk-button-primary">
         Adicionar Banner
      </a>
   </div>
   <div uk-grid class="uk-margin-medium-top">
      <?php foreach ($sliders as $slider) : ?>
         <!-- Seu conteúdo aqui, por exemplo: -->
        
 
         <div class="uk-margin-medium-bottom uk-width-1-3@m ">
            <div class="uk-card uk-card-default">
               <div class="uk-card-media-top">
                  <div class="uk-flex uk-flex-center">
                     <img class="banner_img" src="<?= $this->base_path() ?>uploads/<?= $this->e($slider['imagem']) ?> " alt="">
                  </div>
               </div>
               <div class="uk-card-body">
                  <div class="uk-card-badge uk-label">
                  <?= $slider['id'] ?> 
                 
                  </div>
                  <div><?= $this->e($slider['legenda']) ?></div>
                  <p class="uk-text-meta uk-margin-remove-top">
                     Criado:
                     <time datetime="<?= $this->formatDateToBR($slider['created_at']) ?> ">
                        <?= $this->formatDateToBR($slider['created_at']) ?> 
                     
                     </time>
                  </p>
                
                  <?php if ($slider['ativo'] == 1) : ?> 
                     <p class="uk-alert-success uk-text-center">
                        Ativado
                     </p>
                  <?php else : ?>
                     <p class="uk-alert-danger uk-text-center">
                        Desativado
                     </p>
                  <?php endif; ?>
               </div>
               <div class="uk-card-footer">
                  <div class="uk-grid uk-child-width-1-2">
                     <div>
                        <a href="<?= $this->path_for('slider.update', ['id' => $this->e($slider['id']) ])?>">
                           <button class="uk-button uk-button-default">
                              Editar
                           </button>
                        </a>
                     </div>
                     <div>
                        <button type="button" uk-toggle="target: #modal-apagar<?= $this->e($slider['id']) ?>" class="uk-button uk-button-danger">
                           Apagar
                        </button>
                     </div>
                  </div>
               </div>
               <div id="modal-apagar<?= $this->e($slider['id']) ?>" uk-modal>
                  <div class="uk-modal-dialog uk-modal-body">
                     <form action="<?= $this->path_for('slider.delete') ?>" method="POST">
                        <p class="uk-text-danger uk-text-center">
                           Tem certeza que deseja apagar o ID <?= $this->e($slider['id']) ?>?
                        </p>
                        <!-- Input oculto para passar o ID do slider -->
                        <input type="hidden" name="id" value="<?= $this->e($slider['id']) ?>">

                        <div class="uk-modal-footer uk-text-center">
                           <button class="uk-button uk-button-default uk-modal-close" type="button">
                              Cancelar
                           </button>
                           <!-- Substituído o link por um botão de submit no formulário -->
                           <button type="submit" class="uk-button uk-button-danger">
                              Apagar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</section>
<?= $this->stop() ?>
<?= $this->start('javascript_footer') ?>

<?= $this->stop() ?>