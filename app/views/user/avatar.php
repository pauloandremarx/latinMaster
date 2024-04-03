{% extends "layouts/layout.twig" %}
{% block content %}
  <section class="articles">
    <figure class="image is-128x128 image container">
      <img class="is-rounded" src="{{ base_url() }}/uploads/{{ auth.user.avatar }}"></figure>
      <div class="column is-8 is-offset-2">
        <div class="card article">
          <div class="card-content">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="field">
                <label class="label">
                  E-mail
                </label>
                <div class="file has-name is-boxed">
                  <label class="file-label">
                    <input class="file-input" type="file" name="avatar" accept="image/x-png,image/gif,image/jpeg">
                      <span class="file-cta">
                        <span class="file-icon">
                          <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                          Escolha a imagem…
                                                
                        </span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="field is-grouped">
                  <div class="control">
                    <button type="submit" class="button is-medium is-link">
                      Enviar Avatar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          {% include "components/notifications.twig" %}
        </div>
      </section>
    {% endblock content %}
    