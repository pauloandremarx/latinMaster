<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
<section class="uk-animation-fade" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">

    <div class="uk-container uk-text-center">
        <h3>
            Página não encontrada!
        </h3>
        <a href="<?= $this->path_for('home') ?>" class="uk-button uk-button-danger">
            Voltar
        </a>
    </div>

</section>
<?= $this->stop() ?>