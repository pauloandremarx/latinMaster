<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
<section class="uk-container uk-margin-large-top" uk-height-viewport="expand: true">
   <ul class="uk-breadcrumb">
      <li>
         <a href="<?= $this->path_for('admin') ?>">
            Admin
         </a>
      </li>
      <li>
         <span>
            Post do blog
         </span>
      </li>
   </ul>
   <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-large-top">
      <h2>
         Post do blog

      </h2>
      <a href="<?= $this->path_for('post.create') ?>" class="uk-button uk-button-primary">
         Adcionar um novo post no blog
      </a>
   </div>

   <div class="uk-margin-medium-top uk-child-width-1-3@m" uk-grid>
      <?php foreach ($posts as $post) : ?>
         <div class="uk-padding">
            <div class="uk-card uk-card-default">
               <div class="uk-card-media-top">
                  <div class="uk-flex uk-flex-center">
                     <img class="banner_img" src=" <?= $this->base_path() ?>uploads/<?= $post['thumb'] ?>" alt="">
                  </div>
               </div>
               <div class="uk-card-body">
                  <div class="uk-card-badge uk-label">

                     <?= $post['id'] ?>
                  </div>
                  <p class="">
                     <?= $post['title'] ?>
                  </p>
              
                  <p class="uk-text-meta uk-margin-remove-top">
                     Criado:

                     <time datetime="2016-04-01T19:00">
                        <?= $this->formatDateToBR($post['created_at']) ?>
                     </time>
                  </p>
                  <?php if ($post['published'] == 1) : ?> 
                     <p class="uk-alert-success uk-text-center">
                        Ativado
                     </p>
                  <?php else : ?>
                     <p class="uk-alert-danger uk-text-center">
                        Desativado
                     </p>
                  <?php endif; ?>

                  <p class="uk-text-small">
                     <?= $post['description'] ?>

                  </p>
               </div>
               <div class="uk-card-footer">
                  <div class="uk-grid uk-child-width-1-2">
                     <div>
                        <a href=" <?= $this->path_for('post.update', ['id' =>  $post['id'] ]) ?>">
                           <button class="uk-button uk-button-default">
                              Editar
 
                           </button>
                        </a>
                     </div>
                     <div>
                        <button type="button" uk-toggle="target: #modal-apagar<?= $post['id'] ?>" class="uk-button uk-button-danger">
                           Apagar 

                        </button>
                     </div>
                  </div>
               </div>
               <div id="modal-apagar<?= $post['id'] ?>" uk-modal>
                  <div class="uk-modal-dialog uk-modal-body">
                     <form action="<?= $this->path_for('post.delete') ?>" method="POST">
                        <p class="uk-text-danger uk-text-center">
                           Tem certeza que deseja apagar o ID <?= $post['id'] ?>  ?

                        </p>
                        <!-- Input oculto para passar o ID do post -->
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
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
   </div>
</section>
<?= $this->stop() ?>
<?= $this->start('javascript_footer') ?>

<?= $this->stop() ?>