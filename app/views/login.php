<?php
$emailError = $this->getFlash('email');
$passwordError = $this->getFlash('password');
$message = $this->getFlash('message');
?>

<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
<section class="uk-height-1-1 uk-height-large" uk-height-viewport="expand: true">
    <div class="uk-container uk-height-1-1">
        <div class="uk-child-width-1-2@m uk-height-1-1 uk-grid-match" uk-grid>
            <div class="uk-flex uk-flex-middle uk-height-1-1">
                <img class="login_logo" src="<?= $this->base_path() ?>img/latain_master_h_latin.png" />
            </div>
            <div class="uk-height-1-1 uk-flex uk-flex-middle">
                <aside>
                    <form action="<?= $this->path_for('login.store') ?>" method="POST">
                        <h2 class="title_login">Login de Administrador</h2>
                        <div class="uk-margin">
                            <label for="form-horizontal-text">Email:</label>
                            <input class="<?= $emailError ? 'uk-form-danger' : '' ?> uk-input" name="email" type="email" value="<?= $this->old('email') ?>" />
                            <?php if ($emailError): ?>
                                <div class="uk-alert-danger" uk-alert>
                                    <a class="uk-alert-close" uk-close></a>
                                    <p><?php echo $emailError ?></p>
                                </div>
                            <?php endif; ?>
  
                        </div>
                        <div class="uk-margin">
                            <label for="form-horizontal-text">Senha:</label>
                            <input class="<?= $passwordError ? 'uk-form-danger' : '' ?> uk-input" type="password" name="password" />
                            <?php if ($passwordError): ?>
                                <div class="uk-alert-danger" uk-alert>
                                    <a class="uk-alert-close" uk-close></a>
                                    <p><?php echo $passwordError ?></p>
                                </div>
                            <?php endif; ?>
                           
                        </div>
                        <div style="color:red"><?php echo $message ?></div>
                        <div class="uk-margin uk-flex uk-flex-middle uk-flex-center">
                            <button type="submit" class="uk-button uk-button-large uk-button-default">Entrar</button>
                        </div>
                    </form>
                    <?php if (empty($user->email)): ?>
                        <div class="uk-margin">
                            <div class="uk-flex uk-flex-middle uk-flex-center">
                                <a class="uk-button uk-button-danger" href="<?= $this->path_for('user.create') ?>">Criar administrador</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <form action="<?= $this->path_for('send.forgot') ?>" method="POST">
                            <div class="uk-flex uk-flex-middle uk-flex-center"> 
                                <button type="submit" class="uk-button uk-button-danger">Esqueci a senha</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
    </div>
</section>
<?= $this->end() ?>
