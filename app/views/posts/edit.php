<?php
$bannerError = $this->getFlash('banner');
$thumbeError = $this->getFlash('thumb');

$titleError = $this->getFlash('title');
$conteudoError = $this->getFlash('conteudo');
$descriptionError = $this->getFlash('description');
$publishedError = $this->getFlash('published');

$message = $this->getFlash('message');
?>

<?= $this->layout('layouts/layout') ?>

<!--Javascript-->
<?= $this->start('javascript_header') ?>
<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
<?= $this->end() ?>

<!--mainContent-->
<?= $this->start('mainContent') ?>


<section class="uk-container uk-margin-large-top" uk-height-viewport="expand: true">
  <ul class="uk-breadcrumb">
    <li>
      <a href="<?= $this->path_for('admin') ?>">
        Admin
      </a>
    </li>
    <li>
      <a href="<?= $this->path_for('post') ?>">
        Todos os post
      </a>
    </li>
    <li>
      <span>
        Editar Post
      </span>
    </li>
  </ul>
  <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-large-top">
    <h2>
      Editar Post
    </h2>
  </div>

  <?php if ($message) : ?>
      <div><?= $message ?></div>
    <?php endif; ?>


  <form class="uk-margin-medium-top" action="<?= $this->path_for('post.update', ['id' => $post->id]) ?>" method="POST" enctype="multipart/form-data" id="form" name="formulario">
    <fieldset class="uk-fieldset">
      <div class="uk-margin">
        <p class="title_form">
          Titulo:
        </p>
        <input class="uk-input" name="title" type="text" maxlength="300" placeholder="" value="<?= $post->title ?>  " />
      </div>
      <?php if ($titleError) : ?>
        <div class="uk-margin-top">
          <?= $titleError ?>
        </div>
      <?php endif; ?>

      <div class="uk-margin">
        <p class="title_form">
          Texto do post:
        </p>
        <div class="uk-margin"> 

        <div uk-form-custom="target: true" class="uk-margin-bottom">
          <input type="file" multiple id="uploadImage" accept="image/*">
          <button class="uk-button uk-button-default" type="button" tabindex="-1">Selecionar arquivos para inserir no conteudo do blog</button>
          <span></span>
        </div>

          <!-- Campo oculto para armazenar o conteúdo do editor TUI -->
          <textarea id="editor" name="conteudo"><?= htmlspecialchars($post->conteudo, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
      </div>

      <?php if ($conteudoError) : ?>
        <div class="uk-margin-top">
          <?= $conteudoError ?>
        </div>
      <?php endif; ?>


      <div class="uk-margin">
        <p class="title_form">
          Descrição:
        </p>
        <input class="uk-input" name="description" type="text" placeholder="" maxlength="200" maxlength="200" value="<?= htmlspecialchars($post->description) ?>  " />
      </div>

      <?php if ($descriptionError) : ?>
        <div class="uk-margin-top">
          <?= $descriptionError ?>
        </div>
      <?php endif; ?>



      <div class="uk-margin">
        <p class="title_form uk-margin-top">Deseja que o post esteja ativo: </p>

        <select class="uk-select" name="published">
          <?php $value_published = $post->published; ?>
          <option value="0" <?= $value_published == '0' ? 'selected' : '' ?>>
            Desativado
          </option>
          <option value="1" <?= $value_published == '1' ? 'selected' : '' ?>>
            Ativado
          </option>
        </select>

        <?php if ($publishedError) : ?>
          <div class="uk-margin-top">
            <?= $publishedError ?>
          </div>
        <?php endif; ?>
      </div>


      <div class="uk-margin" uk-margin>
        <p class="title_form">
          Imagem do banner:
        </p>
        <!-- novo elemento! -->
        <div uk-form-custom>
          <input type="file" id="file-chooser" accept="image/*, video/*" name="banner" />
          <button class="uk-button uk-button-default" type="button" tabindex="-1">
            Selecione uma imagem
          </button>
        </div>
        <!-- invisível -->
        <img id="preview-img" class=" banner_img uk-display-block uk-responsive-width" <?php if ($post->banner) : ?> src="<?= $this->base_path() ?>uploads/<?= $post->banner ?>" <?php endif;  ?> />
        <p>
          <input class="uk-checkbox" type="checkbox" name="apagar_img" value="1" />
          Deixar sem imagem
        </p>
      </div>
      <div class="uk-margin" uk-margin>
        <p class="title_form">
          Imagem da thubmail:
        </p>
        <!-- novo elemento! -->
        <div uk-form-custom>
          <input type="file" id="file-chooser_b" type="file" accept="image/*" maxlength="150" name="thumb" />
          <button class="uk-button uk-button-default uk-block" type="button" tabindex="-1">
            Selecione a imagem
          </button>
        </div>
        <!-- invisível -->

        <img id="preview-img_b" class=" banner_img uk-display-block uk-responsive-width" <?php if ($post->thumb) : ?> src="<?= $this->base_path() ?>uploads/<?= $post->thumb ?>" <?php endif;  ?> />
        <p>
          <input class="uk-checkbox" type="checkbox" name="apagar_img2" value="1" />
          Deixar sem imagem

        </p>
      </div>

      <div class="uk-grid">
        <div class="uk-margin">
          <button type="submit" class="uk-button salvar-f" id="salvar">
            Salvar
          </button>
        </div>
        <div>
          <a href="<?= $this->path_for('post') ?>" class="uk-button voltar-f uk-margin-medium-bottom">
            Voltar
          </a>
        </div>
      </div>
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
            <p id="text-mensage"></p>
            <p>
              Deseja salvar mesmo assim?
            </p>
          </div>
          <div class="uk-modal-footer uk-text-right">
            <button class="uk-button voltar-f  uk-modal-close">
              Voltar
            </button>
            <button class="uk-button salvar-f" type="submit" id="salvar2">
              Salvar
            </button>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</section>


<?= $this->end() ?>
<!--Javascript-->
<?= $this->start('javascript_footer') ?>
<script src="<?= $this->base_path() ?>libs/ckeditor/ckeditor.js"></script>


<script>
 
 UPLOADCARE_PUBLIC_KEY = 'a584ad1c6b874a2e7af2';
CKEDITOR.replace('editor', {
        extraPlugins: 'autogrow', // Certifique-se de que o plugin 'autogrow' está incluído.
        autoGrow_minHeight: 600,  // Altura mínima do editor em pixels.
        autoGrow_maxHeight: 1000,  // Altura máxima do editor. 0 significa ilimitado.
        autoGrow_bottomSpace: 50, // Espaço extra após o conteúdo.
        height: 600                // Altura inicial do editor.
    });
 
 

  document.getElementById('uploadImage').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = function() {
        const imgElement = document.createElement('img');
        imgElement.src = reader.result;
        imgElement.onload = function() {
            const canvas = document.createElement('canvas');
            const max_width = 800; // Largura máxima para a imagem comprimida
            const scaleSize = max_width / imgElement.width;
            canvas.width = max_width;
            canvas.height = imgElement.height * scaleSize;
            
            const ctx = canvas.getContext('2d');
            ctx.drawImage(imgElement, 0, 0, canvas.width, canvas.height);
            const srcEncoded = ctx.canvas.toDataURL(file.type, 0.65); // 0.75 é o nível de qualidade (0 a 1)
            
            // Inserir a imagem comprimida no CKEditor
            CKEDITOR.instances.editor.insertHtml('<img src="' + srcEncoded + '"/>');
        };
    };
});


</script>
<script>
  var previewImg;
  var lembrar_img;
  if (document.getElementById("preview-img").src != "") {
    document.getElementById("preview-img").classList.add("img_bg_escuro");
  }
  document.getElementById("file-chooser").onchange = function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview-img").src = e.target.result;
      previewImg = document.getElementById("preview-img");
      lembrar_img = previewImg;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  };

  const apagar = document.querySelector('input[name=apagar_img]');

  apagar.onchange = e => {
    if (apagar.checked == true) {
      previewImg.src = "";
      previewImg.classList.remove("img_bg_escuro");

    } else {
      previewImg.src = lembrar_img;
      previewImg.classList.add("img_bg_escuro");
    }
  };



  var previewImg_b;
  var lembrar_img_b;
  if (document.getElementById("preview-img_b").src != "") {
    document.getElementById("preview-img_b").classList.add("img_bg_escuro");
  }
  document.getElementById("file-chooser_b").onchange = function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview-img_b").src = e.target.result;
      previewImg_b = document.getElementById("preview-img_b");
      lembrar_img_b = previewImg_b;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  };

  const apagar2 = document.querySelector('input[name=apagar_img2]');

  apagar2.onchange = e => {
    if (apagar2.checked == true) {
      previewImg_b.src = "";
      previewImg_b.classList.remove("img_bg_escuro");

    } else {
      previewImg_b.src = lembrar_img_b;
      previewImg_b.classList.add("img_bg_escuro");
    }
  };


  document.querySelector.bind(document)('#salvar').addEventListener("click", function(event) {

    if (document.querySelector.bind(document)('input[name=title]').value == null || document.querySelector.bind(document)('input[name=title]').value == "") {
      event.preventDefault();
      document.querySelector.bind(document)('#acionar-btn').click();
      document.querySelector.bind(document)('#text-mensage').innerHTML = "O campo <b>titúlo</b> está vazio!";
      document.querySelector.bind(document)('#salvar2').addEventListener("click", function(event) {
        document.formulario.submit();
      });
    }

  });
</script>
<?= $this->end() ?>