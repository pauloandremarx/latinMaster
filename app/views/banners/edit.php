<?php
$imagemError = $this->getFlash('imagem');
$imagem_mobileError = $this->getFlash('imagem_mobile');

$urlError = $this->getFlash('url');
$ordemError = $this->getFlash('ordem');
$ativoError = $this->getFlash('ativo');
$message = $this->getFlash('message');
?>


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
         <a href="<?= $this->path_for('slider') ?>  ">
            Todos Banners
         </a>
      </li>
      <li>
         <span>
            Editar Banner
         </span>
      </li>
   </ul>
   <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-large-top">
      <h2>
      Editar Banner
      </h2>
   </div>

   <?php if (isset($message)) : ?>
            <div><?= $message ?></div>
         <?php endif; ?>
   <form class="uk-margin-medium-top" action="<?= $this->path_for('slider.update', ['id' => $slider->id]) ?>" method="POST" enctype="multipart/form-data" id="form" name="formulario">
      <input type="hidden" name="_method" value="PUT">
      <fieldset class="uk-fieldset">
         <div class="uk-margin" uk-margin>
            <p class="title_form">
               Selecione a imagem do banner desktop (Atual: <?= htmlspecialchars($slider->imagem) ?>). Recomendado de 1920px x 768px:
            </p>
            <div uk-form-custom>
               <input class="file-button file-input" id="file-chooser-desktop" type="file" name="imagem" />
               <button class="uk-button uk-button-default" type="button" tabindex="-1">
                  Selecione a imagem
               </button>
            </div>
            <img id="preview-img-desktop" class="uk-display-block uk-responsive-width" width="400" src="<?= $this->base_path() ?>uploads/<?= $slider->imagem ?> " />

            
            <?php if (isset($imagemError)) : ?>
               <div class="uk-margin-top">
                  <?= $imagemError ?>
               </div>
            <?php endif; ?>
         </div>

         <div class="uk-margin" uk-margin>
            <p class="title_form">
               Selecione a imagem do banner mobile (Atual: <?= htmlspecialchars($slider->imagem_mobile) ?>). Recomendado de 587px x 978px:
            </p>
            <div uk-form-custom>
               <input class="file-input" id="file-chooser-mobile" type="file" name="imagem_mobile" />
               <button class="uk-button uk-button-default" type="button" tabindex="-1">
                  Selecione a imagem
               </button>
            </div>
           
            <img id="preview-img-mobile" class="uk-display-block uk-responsive-width" width="200" src=" <?= $this->base_path() ?>uploads/<?= $slider->imagem_mobile ?> " />

            <?php if (isset($imagem_mobileError)) : ?>
               <div class="uk-margin-top">
                  <?= $imagem_mobileError ?>
               </div>
            <?php endif; ?>
         </div>

         <div class="uk-margin">
            <p class="title_form">
               URL link:
            </p>
            <input class="uk-input w535" name="url" maxlength="300" type="text" value="<?= htmlspecialchars($slider->legenda) ?>" />

            <?php if (isset($urlError)) : ?>
               <div class="uk-margin-top">
                  <?= $urlError ?>
               </div>
            <?php endif; ?>
         </div>

         <div class="uk-grid">
            <div>
               <p class="title_form uk-margin-top">
                  Ordem do banner:
               </p>
               <input class="uk-input" name="ordem" type="number" min="1" max="999" step="1" value="<?= $slider->ordem ?>">

               <?php if (isset($ordemError)) : ?>
                  <div class="uk-margin-top">
                     <?= $ordemError ?>
                  </div>
               <?php endif; ?>
            </div>
            <div>
               <div>
                  <p class="title_form uk-margin-top">
                     Deseja que o banner esteja ativo:
                  </p>
                  <select class="uk-select" name="ativo">
                     <option value="0" <?= $slider->ativo == '0' ? 'selected' : '' ?>>
                        Desativado
                     </option>
                     <option value="1" <?= $slider->ativo == '1' ? 'selected' : '' ?>>
                        Ativado
                     </option>
                  </select>

                  <?php if (isset($ativoError)) : ?>
                     <div class="uk-margin-top">
                        <?= $ativoError ?>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>

      

         <div class="uk-grid">
            <div class="uk-margin">
               <button type="submit" class="uk-button salvar-f" id="salvar">
                  Atualizar
               </button>
            </div>
            <div>
               <a href="<?= $this->path_for('slider') ?>" class="uk-button voltar-f uk-margin-medium-bottom">
                  Voltar
               </a>
            </div>
         </div>




      </fieldset>
   </form>

   <a hidden href="#modal-center" id="acionar-btn" uk-toggle>
      Open
   </a>
   <div id="modal-center" class="" uk-modal>
      <div class="uk-modal-dialog">
         <button class="uk-modal-close-default" type="button" uk-close></button>
         <div class="uk-modal-header">
            <h2 class="uk-modal-title uk-text-danger">
               ALERTA
            </h2>
         </div>
         <div class="uk-modal-body texto_alerta_form">
            <p id="text-mensage" class="uk-text-center"></p>
            <p class="uk-text-center">
               Deseja salvar mesmo assim?
            </p>
         </div>
         <div class="uk-modal-footer uk-text-right">
            <button class="uk-button voltar-f uk-modal-close">
               Voltar
            </button>
            <button class="uk-button salvar-f" type="submit" id="salvar2">
               Salvar
            </button>
         </div>
      </div>
   </div>
</section>


<?= $this->stop() ?>
<?= $this->start('javascript_footer') ?>
<script>
   document.getElementById("file-chooser-desktop").onchange = function() {
      var reader = new FileReader();
      reader.onload = function(e) {
         // get loaded data and render thumbnail.
         document.getElementById("preview-img-desktop").src = e.target.result;
         var previewImg = document.getElementById("preview-img-desktop");
         var lembrar_img = previewImg;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
   };



   document.getElementById("file-chooser-mobile").onchange = function() {
      var reader = new FileReader();
      reader.onload = function(e) {
         // get loaded data and render thumbnail.
         document.getElementById("preview-img-mobile").src = e.target.result;
         var previewImg3 = document.getElementById("preview-img-mobile");
         var lembrar_img3 = previewImg3;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
   };




   document.getElementById('salvar').addEventListener("click", function(event) {
      var previewImg = document.getElementById('preview-img-desktop');
      var textMessage = document.getElementById('text-mensage');
      var acionarBtn = document.getElementById('acionar-btn');
      var inputUrl = document.querySelector('input[name=url]');

      if (previewImg.getAttribute('src') == "") {
         event.preventDefault();
         acionarBtn.click();
         textMessage.innerHTML = "O campo <b>banner</b> está vazio!";
         document.getElementById('salvar2').addEventListener("click", function(event) {
            document.formulario.submit();
         });
      } else if (inputUrl.value == null || inputUrl.value == "") {
         event.preventDefault();
         acionarBtn.click();
         textMessage.innerHTML = "O campo <b>URL</b> está vazio!";
         document.getElementById('salvar2').addEventListener("click", function(event) {
            document.formulario.submit();
         });
      }
   });
</script>
<?= $this->stop() ?>