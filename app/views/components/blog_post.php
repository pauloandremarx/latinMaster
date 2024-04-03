<section class="bg_blog uk-position-relative">
        <span id="blog"></span>
        <div class="uk-container uk-container-large uk-position-relative">
            <h2>
                Confira outros tópicos interessantes no nosso blog!           
            </h2>
            <div uk-slider class="uk-position-relative my-uk-slider" tabindex="-1">
                <div class="uk-slider-container">
                    <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid news_slider uk-flex-center">
                    <?php foreach ($posts  as $post) : ?>   
                        <?php $verify = str_starts_with($currentPath, $this->path_for('blog.single', ['id'=> $post['id'] ]));  ?> 
                      
                        <?php if(!$verify): ?>
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
                            <?php endif; ?>
                    <?php endforeach; ?>  
                    </ul>
                </div>
                <a class="uk-position-center-left uk-position-small z3" href uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small z3" href uk-slidenav-next uk-slider-item="next"></a>
            </div>
        </div>
    </section>