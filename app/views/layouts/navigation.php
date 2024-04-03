<div class="z_index_nav_99 " id="home">
    <div uk-sticky="sel-target: .bg_stick; cls-active: uk-navbar-sticky; animation: uk-animation-fade; top: 400;">
        <div class="bg_stick">
            <!-- MENU DESKTOP ********************************************************************* -->
            <nav class="uk-navbar-container uk-navbar-transparent  color_nav uk-visible@m" uk-navbar>
                <div class="uk-navbar-left ">
                    <ul class="uk-navbar-nav uk-flex uk-flex-middle uk-height-1-1">
                        <li class="">
                            <a class="" href="<?= $this->base_path()  ?>" alt=" ">
                                <img class="logo_left" src="<?= $this->base_path()  ?>img/logo_latin.png" alt="Logo Latina Master" />
                            </a>
                        </li> 
                    </ul>
                </div>
                <div class="uk-navbar-center   uk-width-1-1" >
                    <ul class="uk-navbar-nav  uk-flex uk-flex-middle  uk-height-1-1 scroll-active uk-width-1-1">
                        <li class="">
                            <span class="border">
                                <a class="uk-button uk-button-text" href="<?= $this->base_path() ?>?#quemsomos" uk-scroll alt="Quem somos">
                                    Quem somos
                                </a>
                            </span>
                        </li>
                        <li class="">
                            <span class="border">
                                <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#solucoes" uk-scroll alt="Soluções">
                                    Soluções
                                </a>
                            </span>
                        </li>
                        <li class="">
                            <span class="border">
                                <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#faq" uk-scroll alt="FAQ">
                                    FAQ
                                </a>
                            </span>
                        </li>
                        <li class="">
                            <span class="border">
                                <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#blog" uk-scroll alt="Blog">
                                    Blog
                                </a>
                            </span>
                        </li>

                        <li class="">
                            <span class="border">
                                <?php if ($this->e($currentPath) === $this->path_for('home')): ?>
                                    <a class="uk-button uk-button-aliado" href="#form_aliado" uk-scroll alt="Seja um aliado">Seja um aliado</a>
                                <?php else: ?>
                                    <a class="uk-button uk-button-aliado" href="<?= $this->base_path() ?>?#form_aliado" alt="Seja um aliado">Seja um aliado</a>
                                <?php endif; ?>
                            </span>
                        </li>
       
                    </ul>
                </div>
                <div class="uk-navbar-right ">
                    <ul class="uk-navbar-nav    uk-flex uk-flex-middle uk-height-1-1">
                        <li class="">
                            <a class="" href="https://alephgroupcorp.com/" target="_blank" title="alephgroupcorp">
                                <img class="logo_right" src="<?= $this->base_path()  ?>img/logo_alef_group_latin.png" alt="logo_alef_group_latin" />
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- MENU MOBILE ********************************************************************* -->
            <nav class="uk-navbar-container uk-navbar-transparent color_nav uk-hidden@m" uk-navbar>
                <div class="uk-navbar-left ">
                    <ul class="uk-navbar-nav uk-flex uk-flex-middle uk-height-1-1">
                        <li class="">
                            <a class="" href="<?= $this->base_path()  ?>" alt=" ">
                                <img class="logo_left" src="<?= $this->base_path()  ?>img/logo_latin.png" alt="Logo Latina Master" />
                            </a>
                        </li>
                        <li class="uk-hidden@m">
                            <a class="" href="<?= $this->base_path()  ?>" alt=" ">
                                <img class="logo_right" src="<?= $this->base_path()  ?>img/logo_alef_group_latin.png" alt="logo_alef_group_latin" />
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right ">
                    <div class="uk-navbar-nav ">
                        <div class="">
                            <a class="tamanho_nav_mobile" uk-toggle="target: #offcanvas-nav" class="">
                                <span class="text_white" uk-navbar-toggle-icon></span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<div id="offcanvas-nav" class="" uk-offcanvas="overlay: false; flip:true">
    <div class="uk-offcanvas-bar">
        <div class="uk-flex uk-flex-right">
            <button class="uk-close-large uk-offcanvas-close" type="button" uk-close></button>
        </div>
        <div class="uk-height-1-1 uk-flex uk-flex-column">
            <ul class=" uk-nav-left ">
                <li class="logo_offcanvas">
                    <a class="" href="#">
                        <img src="<?= $this->base_path()  ?>img/latain_master_h_latin.png" alt="Latin Master" />
                    </a>
                </li>
                <li class="">
                    <span class="border">
                        <a class="uk-button uk-button-text" href="<?= $this->base_path() ?>?#quemsomos" uk-scroll alt="Quem somos">
                            Quem somos
                        </a>
                    </span>
                </li>
                <li class="">
                    <span class="border">
                        <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#solucoes" uk-scroll alt="Soluções">
                            Soluções
                        </a>
                    </span>
                </li>
                <li class="">
                    <span class="border">
                        <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#faq" uk-scroll alt="faq">
                            FAQ
                        </a>
                    </span>
                </li>
                <li class="">
                    <span class="border">
                        <a class=" uk-button uk-button-text" href="<?= $this->base_path() ?>?#blog" uk-scroll alt="Blog">
                            Blog
                        </a>
                    </span>
                </li>

                <li class="">
                    <span class="border">
                        <a class=" uk-button uk-button-aliado" href="<?= $this->base_path() ?>?#form_aliado" uk-scroll alt="Form">
                            Seja um aliado
                        </a>
                    </span>
                </li>
        
            </ul>
        </div>
    </div>
</div>

