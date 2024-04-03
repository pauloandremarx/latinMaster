<?php

$nameError = $this->getFlash('name');
$emailError = $this->getFlash('email'); 
$passwordError = $this->getFlash('password'); 
$message = $this->getFlash('message');

?>

<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?> 

<section class="uk-height-1-1 uk-height-large" uk-height-viewport="expand: true">
        <div class="uk-container uk-height-1-1">
            <div class="uk-child-width-1-2@m uk-height-1-1 uk-grid-match" uk-grid>
                <div class="uk-flex uk-flex-middle   uk-height-1-1">
                    <img class="login_logo" src="<?= $this->base_path()  ?>/img/latain_master_h_latin.png" />
                </div>
                <div class="uk-height-1-1 uk-flex uk-flex-middle">
                    <form method="POST" action="" >
                        <div class="uk-width-1-1">
                            <p class="">
                                Nome Completo
                                                            
                            </p>
                            <div class="uk-margin">
                                <input class="uk-input  <?= $nameError ? 'uk-alert-danger' : '' ?>" name="name" type="text" placeholder="Ex: João Santos" />
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                            </div>
                            <?php if($nameError) : ?> 
                                <?= $nameError  ?>
                            <?php endif; ?>

                        </div>
                        <div class="uk-width-1-1">
                            <p class="">
                                E-mail
                                                            
                            </p>
                            <div class="uk-margin">
                                <input class="uk-input <?= $emailError ? 'uk-alert-danger' : '' ?>" name="email" type="email" placeholder="marcuspereira@example.com" />
                            </div>
                            <?php if($emailError) : ?> 
                                <?= $emailError  ?>
                            <?php endif; ?>
                        </div>
                        <div class="uk-width-1-1">
                            <p class="">
                                Senha                         
                            </p>
                            <div class="uk-margin">
                                <input class="uk-input<?= $passwordError ? 'uk-alert-danger' : '' ?>" name="password" type="password" placeholder="*****" />
                            </div>
                            <?php if($passwordError) : ?> 
                                <?= $passwordError  ?>
                            <?php endif; ?>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="uk-button uk-button-large uk-button-default">
                                    Cadastrar                     
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?= $this->stop() ?>