{% extends "layouts/layout.twig" %}
{% block content %}
   <section class="bg_formularios_c">
      <div class="uk-container" uk-height-viewport="expand: true">
         <div class="uk-grid">
            <div class="uk-width-1-1 uk-flex uk-flex-middle uk-flex-left">
               <div>
                  <a href="{{ path_for('servidor') }}" class="voltar-btn">
                     Voltar
                  </a>
               </div>
               <div>
                  <h1 class="admin-item-title">
                     Edite a copia de email
                  </h1>
               </div>
            </div>
         </div>
         <form class="uk-margin-medium-top" action="{{ path_for('com_copia.edit', {'id': com_copia.id }) }}" method="POST" enctype="multipart/form-data" id="form" name="formulario">
            <fieldset class="uk-fieldset">
               <div class="uk-margin w535">
                  <p class="title_form">
                     E-mail:
                  </p>
                  <input class="uk-input" name="email" maxlength="399" type="text" value="{{ com_copias.email }}"></div>
                  <div class="uk-margin w535">
                     <p class="title_form">
                        Nome:
                     </p>
                     <input class="uk-input" name="nome" maxlength="399" type="text" value="{{ com_copias.nome }}"></div>
                     <div class="uk-grid">
                        <div class="uk-margin">
                           <button type="submit" class="uk-button salvar-f" id="salvar">
                              Salvar 
                           </button>
                        </div>
                        <div>
                           <a href="{{ path_for('servidor') }}" class="uk-button voltar-f uk-margin-medium-bottom">
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
                              <h2 class="uk-modal-title uk-text-danger uk-text-center">
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
            </div>
         </section>
         {% block js %}
            <script>
   
 
   
      $('#salvar').addEventListener("click", function(event){ 
      
      if ( $('input[name=email]').value == null || $('input[name=email]').value == ""){
          event.preventDefault();
           $('#acionar-btn').click();
           $('#text-mensage').innerHTML = "O campo <b>email</b> está vazio!";
           $('#salvar2').addEventListener("click", function(event){   document.formulario.submit();  });    
        } 
       
     
      });
   
</script> {% include "components/notifications.twig" %}
         {% endblock %}
      {% endblock %}
      
