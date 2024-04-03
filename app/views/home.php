<?= $this->layout('layouts/layout') ?>
<?= $this->start('mainContent') ?>
<header class="uk-box-shadow-large uk-margin-bottom">
    <div class="uk-position-relative uk-height-1-1" uk-slider="autoplay: true;autoplay-interval:5000;">
        <div class="uk-position-relative">
            <div class="uk-slider-container">
                <ul class="uk-slider-items uk-child-width-1-1 slider-banner">
                    <?php foreach ($sliders->rows as $slider): ?>
                    <li>
                        <a href="href=<?= htmlspecialchars($slider['legenda']); ?>">
                            <img class="uk-width-1-1 uk-visible@m" uk-img uk-cover src="<?= $this->base_path() ?>uploads/<?= htmlspecialchars($slider['imagem']); ?>" alt="<?= htmlspecialchars($slider['legenda']); ?>" title="<?= htmlspecialchars($slider['legenda']); ?>" />
                            <img class="uk-width-1-1 uk-hidden@m" uk-img uk-cover src="<?= $this->base_path() ?>uploads/<?= htmlspecialchars($slider['imagem_mobile']); ?>" alt="<?= htmlspecialchars($slider['legenda']); ?>" title="<?= htmlspecialchars($slider['legenda']); ?>" />
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class=" ">
                <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
            </div>
        </div>
        <ul class="uk-position-bottom uk-slider-nav uk-dotnav uk-flex-center uk-margin dotnav-slider-home"></ul>
    </div>
</header>

<section>
    <span id="quemsomos"></span>
    <div class="uk-container">
        <p class="text-latin-master font-size-text-a1" uk-scrollspy="cls: uk-animation-fade ; target: *; delay: 100; ">
            Latin Master é a


            <strong>
                maior provedora de soluções


            </strong>
            em pneus Hankook da América Latina e associada a um dos mais importantes grupos globais de logística e distribuição no segmento. Desde 2009, explorando todos os caminhos que conduzem a soluções integrais para que nossos clientes possam crescer em seus mercados.


        </p>
        <div class="uk-child-width-1-3@m uk-flex-center uk-grid-match icones_alepg_group uk-grid-large" uk-grid>
            <div>
                <div>
                    <img style=" min-height: 160px; max-height: 160px; margin-top:-30px;" src="<?= $this->base_path()  ?>img/aleph_group_black_latin.png" />
                    <p class="font-size-text-a2">
                        • Fundado em 2020


                        <br />
                        •


                        <strong>
                            16.000 m²


                        </strong>
                        de armazéns


                        <br />
                        •


                        <strong>
                            350.000


                        </strong>
                        pneus para estoque


                        <br />
                        •


                        <strong>
                            2.000.000


                        </strong>
                        de pneus movimentados anualmente


                        <br />
                        •Operação em mais de


                        <strong>
                            30


                        </strong>
                        países.


                    </p>
                </div>
            </div>
            <div>
                <div>
                    <img src="<?= $this->base_path()  ?>img/aleph_distrubution_latin.png" />
                    <p class="font-size-text-a2">

                        Aleph Distribution é nova face das operações que começaram no Panamá em 2009 e no Brasil em 2018. A empresa faz parte do grupo Aleph e está comprometida em oferecer serviços para a indústria de pneus.

                    </p>
                </div>
            </div>
            <div>
                <div>
                    <img src="<?= $this->base_path()  ?>img/aleph_logistics_latin.png" />
                    <p class="font-size-text-a2">
                        Aleph Logistics faz parte do portfólio de empresas do GRUPO ALEPH, comprometidas em fornecer soluções logísticas para a indústria de pneus e operar com mais eficiência na região da América Latina.
                        A Aleph Logística faz parte do
 


                    </p>
                </div>
            </div>
            <div>
                <div>
                    <img src="<?= $this->base_path()  ?>img/nossa_missao_latin.png" />
                    <p class="font-size-text-a2">
                        Buscamos ter sucesso entendendo a dinâmica do mercado e os espaços de oportunidades existentes. Queremos levar as possibilidades a um novo nível, garantindo que os produtos estejam disponíveis onde e quando os clientes precisarem deles.
                    </p>
                </div>
            </div>
            <div>
                <div>
                    <img src="<?= $this->base_path()  ?>img/nossos_valores_latin.png" />
                    <p class="font-size-text-a2">
                        Somos um grupo empresarial com alma de empresa familiar. Buscamos práticas comerciais sustentáveis baseadas em relacionamentos sólidos.


                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="opacity_0" uk-sticky="start: #pneu; animation: uk-fade; end: !#quemsomos; offset: 80; cls-active: fixed" uk-scrollspy="target: > a; cls: uk-animation-fade; delay: 500">
    <a href="#" class="button-fixed" uk-scroll>
        <span uk-icon="icon: arrow-up; ratio: 2"></span>
    </a>
</div>

<section class="uk-position-relative">
    <div class="container_distribuitor">
        <div class="container_mecanico">
            <div class="banner_left_pneu_latin"></div>
        </div>
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
                <h1 class="h1_latin_master_no_brasil">
                    Latin


                    <br />
                    Master


                    <br />
                    no Brasil


                </h1>
            </div>
            <div>
                <h2 class="h2_maior_distribuidor">
                    Maior distribuidor


                    <br />
                    <strong>
                        Hankook do Brasil


                    </strong>
                </h2>
                <img class="img_destribuitor_hankook" src="<?= $this->base_path()  ?>img/logo_hankook_latin.png" />
                <div class="list-destribuitor">
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            Infraestrutura física adequada


                        </span>
                    </p>
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            <strong>
                                Know-how local


                            </strong>
                            (pessoas, sistema, soluções integrais) e capital de giro necessário para crescer o negócio no Brasil sob o nome comercial Latin Master


                        </span>
                    </p>
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            Centro de Distribuição de


                            <strong>
                                Santa Catarina


                            </strong>
                            (localização estratégica) e centro de distribuição em


                            <strong>
                                São Paulo


                            </strong>
                            (33% do mercado)


                        </span>
                    </p>
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            Equipe local com forte apoio da sede no


                            <strong>
                                Panamá


                            </strong>
                        </span>
                    </p>
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            Longa experiência no mercado


                        </span>
                    </p>
                    <p>
                        <object type="image/svg+xml" data="<?= $this->base_path()  ?>img/circule_latin.svg" width="25"></object>
                        <span>
                            Força Financeira - Grande e forte apoio financeiro do Grupo Aleph


                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container_pneu uk-position-relative" id="pneu">
        <div class="uk-child-width-1-2@m">
            <div>
                <img class="img_pneu_3d" src="<?= $this->base_path()  ?>img/pneu_latin.png" alt="pneu_latin" />
            </div>
        </div>
        <div class="uk-flex uk-flex-center">
            <a class="button_laranja" href="#form_aliado" uk-scroll>
                Quero me aliar


            </a>
        </div>
    </div>
</section>
<section class="bg_solucoes">
    <span id="solucoes"></span>
    <div class="uk-container uk-container-small">
        <div class="uk-child-width-1-2@m uk-grid-match" uk-grid>
            <div>
                <h1 class="h1_nossas_solucoes">
                    Nossas


                    <br />
                    Soluções


                </h1>
            </div>
            <div>
                <p class="p_nossas_solucoes">
                    A Latin Master chega ao Brasil trazendo em sua bagagem novas ideias e uma nova cultura.


                </p>
            </div>
        </div>
        <div class="uk-child-width-1-3@m uk-child-width-1-2 icones_solucoes solutions-card" uk-grid>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/icon_1_latin.png" />
                            <p>
                                Aliança entre empresas 
                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Fortaleça seu negócio com parcerias estratégicas. A Latin Master acredita no poder das alianças empresariais para ampliar oportunidades e otimizar resultados no mercado de pneus."


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/icon_2_latin.png" />
                            <p>
                                União de forças


                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Juntos, somos mais fortes. Unimos esforços com nossos parceiros para enfrentar os desafios do mercado e superar expectativas, garantindo sucesso mútuo e satisfação dos clientes."


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/icon_3_latin.png" />
                            <p>
                                Transparência comercial


                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Relações claras, negócios sólidos. Na Latin Master, promovemos uma política de transparência total, desde a origem dos produtos até as práticas comerciais, assegurando confiança e integridade."


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/icon_4_latin.png" />
                            <p class="m-w-150">
                                Maximização de lucros para todos


                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Prosperidade compartilhada. Nosso modelo de negócio visa maximizar lucros de maneira justa e equitativa, garantindo que todos os envolvidos - de fornecedores a clientes - prosperem juntos."


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/icon_5_latin.png" />
                            <p>
                                Minimização de riscos


                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Reduzir riscos, aumentar eficiência. Com estratégias focadas na minimização de perdas, a Latin Master trabalha para que o seu inventário se converta em lucro, sem desperdícios."


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="solutions-card-inner">
                        <div class="solutions-card-face solutions-card-front">
                            <img src="<?= $this->base_path()  ?>img/aleph_group_red_latin.png" />
                            <p class="m-w-190">
                                Infraestrutura e Força financeira do Grupo Aleph


                            </p>
                        </div>
                        <div class="solutions-card-face solutions-card-back">
                        "Estrutura forte, apoio confiável. O Grupo Aleph sustenta seu negócio com inovação e solidez financeira, preparando-o para liderar no futuro."

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg_money">
    <div class="uk-height-1-1 uk-container uk-container-small padding_top_bottom">
        <div class="uk-height-1-1 uk-child-width-1-2@m" uk-grid>
            <div>
                <div class="uk-height-1-1 uk-flex uk-flex-middle">
                    <img class="logo_money_latin" src="<?= $this->base_path()  ?>img/money_latin.png" />
                </div>
            </div>
            <div>
                <div class="uk-flex uk-flex-middle uk-flex-center">
                    <h2 class="h2_ganha">
                        Esqueça o perde


                        <br />
                        e ganha do mercado.


                        <br />
                        Latin Master apresenta


                        <br />
                        o


                        <strong>
                            Ganha-Ganha


                        </strong>
                        .


                    </h2>
                </div>
            </div>
        </div>
    </div>
    <aside class="bg_era_comercial">
        <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-height-1-1">
            <p class="uk-flex uk-flex-middle text-uma-nova-era">
                Uma nova era comercial


            </p>
        </div>
    </aside>
</section>
<section class="bg_duvidas">
    <div class="uk-container">
        <div class="uk-flex uk-flex-center">
            <a class="button_red" href="#form_aliado" uk-scroll>
                Saiba mais


            </a>
        </div>
        <p class="uk-text-center p-converse">
            Converse agora com nossos especialistas


        </p>
        <span id="faq"></span>
        <h2 class="h2_duvidas">
            Dúvidas frequentes sobre a Latin Master


        </h2>
        <div class="container_acordion">
            <ul uk-accordion>
                <li class="uk-open">
                    <a class="uk-accordion-title" href>
                        O que é a Latin Master?


                    </a>
                    <div class="uk-accordion-content">
                        <p>
                        "Parceira estratégica no atacado, varejo e e-commerce, a Latin Master é sinônimo de qualidade e inovação em pneus. Nosso compromisso com eficiência logística, suporte financeiro e satisfação total do cliente impulsiona vendas e enriquece a experiência de compra em todos os canais."
                        </p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>
                        Latin Master distribui quais marcas de pneus?


                    </a>
                    <div class="uk-accordion-content">
                        <p>
                        "Somos o principal distribuidor de pneus Hankook, incluindo as linhas íON, Ventus, Dynapro e Kinergy. A Hankook é reconhecida por sua inovação, conforto ao dirigir, compromisso com a sustentabilidade e o fornecimento de pneus de alto desempenho."

                        </p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>
                        Como funciona o modelo de negócios?


                    </a>
                    <div class="uk-accordion-content">
                        <p>
                        "Nosso modelo de negócios é baseado em parcerias estratégicas e alianças robustas, garantindo uma cadeia de suprimentos eficiente e uma distribuição ágil que atende as necessidades de nossos clientes com precisão."

                        </p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>
                        Como me torno um aliado da Latin Master?


                    </a>
                    <div class="uk-accordion-content">
                        <p>
                        "Para se tornar um aliado da Latin Master, entre em contato conosco através do nosso site. Buscamos parceiros comprometidos com a excelência e inovação para crescerem conosco."
                        </p>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title" href>
                        Qual a relação da Latin Master com o Grupo Aleph?


                    </a>
                    <div class="uk-accordion-content">
                        <p>
                        "Latin Master faz parte do Grupo Aleph, beneficiando-se de sua forte infraestrutura, inovação constante e solidez financeira para oferecer soluções de ponta no mercado de pneus."

                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="bg_blog uk-position-relative">
    <span id="blog"></span>
    <div class="uk-container uk-container-large uk-position-relative">
        <h2>
            Saiba tudo sobre o universo dos pneus


        </h2>
        <div uk-slider class="uk-position-relative my-uk-slider" tabindex="-1">
            <div class="uk-slider-container">
                <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid news_slider">

                    <?php foreach ($posts  as $post) : ?> 
                            <li>
                                <div class="height-1-1">
                                    <a class="card_blog" href="<?= $this->path_for('blog.single', ['id' => $post['id']]) ?>" title="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>">
                                        <div class="img_container">
                                            <img src="<?= $this->baseUrl() ?>uploads/<?= htmlspecialchars($post['thumb'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($post['title'] , ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($post['title']  , ENT_QUOTES, 'UTF-8') ?>" uk-cover />
                                        </div>
                                        <p>
                                            <span>
                                                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                            <?= htmlspecialchars($post['description'] , ENT_QUOTES, 'UTF-8') ?>
                                        </p>
                                    </a>
                                </div>
                            </li> 
                    <?php endforeach; ?>
                </ul>
            </div>
            <a class="uk-position-center-left uk-position-small z3" href uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small z3" href uk-slidenav-next uk-slider-item="next"></a>
        </div>
    </div>
</section>
<section class="bg_form">
    <span id="form_aliado"></span>
    <div class="uk-container uk-container-small">
        <p class="p_text_converse">
            Converse com os nossos especialistas e compare os modelos


            <br />
            de negócios do mercado com as soluções Latin Master.


        </p>
        <form class="uk-form container_form" action="<?= $this->path_for('send.email') ?>" method="post">
            <label for="name">
                <input class="uk-input" name="name" id="name" autocomplete="name" type="text" placeholder="*Nome:" />
                <span id="name-error" class="error-message"></span>
            </label>
            <label for="empresa">
                <input class="uk-input" name="empresa" autocomplete="empresa" id="empresa" type="text" placeholder="*Empresa:" />
                <span id="empresa-error" class="error-message"></span>
            </label>
            <label for="tel">
                <input class="uk-input" name="tel" id="tel" autocomplete="tel" type="text" maxlength="15" placeholder="*Telefone:" />
                <span id="tel-error" class="error-message"></span>
            </label>
            <label for="email">
                <input class="uk-input" name="email" id="email" autocomplete="email" type="email" placeholder="*E-mail:" />
                <span id="email-error" class="error-message"></span>
            </label>
            <label for="departamento">
                <select class="uk-input uk-select" name="departamento" id="departamento">
                    <option selected disabled value="">*Selecione um departamento:</option>
                    <option value="comercial">Comercial</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="recursos_humanos">Recursos Humanos</option>
                </select>
                <span id="departamento-error" class="error-message"></span>
            </label>
            <label for="mensagem">
                <textarea class="uk-textarea" name="mensagem" id="mensagem" placeholder="*Mensagem" rows="6"></textarea>
                <span id="mensagem-error" class="error-message"></span>
            </label> 


            <div class="uk-flex uk-flex-center">
                <button type="submit" class="button_verde">
                    <span class="button-text">Seja um aliado</span>
                    <span class="uk-margin-small-left" uk-spinner="ratio: 0.6" style="display: none;"></span>
                </button> 
            </div>
            <span id="form-error" class="error-message"></span>
        </form>
    </div>
</section>

<div id="responseModal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Status do Envio</h2>
        <p id="modalMessage" class="uk-text-center">Aguardando envio...</p>
    </div>
</div>


<?= $this->stop() ?>
<?= $this->start('javascript_footer') ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="<?= $this->base_path()  ?>js/validateForm.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.container_form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const isValidName = validateName(document.getElementById('name').value);
            const isValidEmail = validateEmail(document.getElementById('email').value);
            const isValidTel = validaTelefone(document.getElementById('tel').value);
            const isValidMessage = validateMensagem(document.getElementById('mensagem').value);
            const isValidDepartamento = validateDepartamento(document.getElementById('departamento').value);
            const isValidEmpresa = validateEmpresa(document.getElementById('empresa').value);

            if (!isValidName || !isValidEmail || !isValidTel || !isValidMessage || !isValidDepartamento || !isValidEmpresa) {
                console.log("Formulário inválido, envio bloqueado");
                displayFormError('Por favor, corrija os erros antes de enviar.');
                return;
            }

            clearFormError();

            const submitButton = form.querySelector('button[type="submit"]');
            const buttonText = submitButton.querySelector('.button-text');
            const buttonSpinner = submitButton.querySelector('[uk-spinner]');

            buttonText.textContent = 'Enviando...';
            buttonSpinner.style.display = 'inline-block';
            submitButton.disabled = true;

            axios.post(form.action, new FormData(form))
            .then(function(response) {
                document.getElementById('modalMessage').textContent = response.data.message;
                UIkit.modal('#responseModal').show();
                buttonText.textContent = 'Cadastrado';
                submitButton.disabled = true; // Mantém o botão desabilitado após envio bem-sucedido
            })
            .catch(function(error) {
                let errorMessage = "Falha ao enviar o e-mail. Por favor, tente novamente.";
                if (error.response && error.response.data.message) {
                    errorMessage = error.response.data.message;
                }
                document.getElementById('modalMessage').textContent = errorMessage;
                UIkit.modal('#responseModal').show();
                submitButton.disabled = false;
                buttonText.textContent = 'Seja um aliado';
                buttonSpinner.style.display = 'none';
            });
        });
    });

</script>


<?= $this->stop() ?>