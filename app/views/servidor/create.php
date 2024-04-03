{% extends "layouts/layout.twig" %}
{% block content %}
   <section class="bg_formularios_c">
      <div class="uk-container" uk-height-viewport="expand: true">
         div class="uk-grid uk-margin-top">
                  
         <div class="uk-width-1-2@m uk-flex uk-flex-left">
            <a href="{{ path_for('admin') }}" class="voltar-btn">
               Voltar
            </a>
         </div>
         <div class="uk-width-1-2@m uk-flex uk-flex-right"></div>
      </div>
      <div>
         <h1 class="admin-item-title">
            Editar o servidor de email
         </h1>
      </div>
      <form class="uk-margin-medium-top" action="{{ path_for('servidor.create') }}" method="POST" enctype="multipart/form-data" id="form" name="formulario">
         <fieldset class="uk-fieldset">
            <div class="uk-margin w535">
               <p class="title_form">
                  E-mail:
               </p>
               <input class="uk-input" name="email" maxlength="399" type="text"></div>
               <div class="uk-margin w535">
                  <p class="title_form">
                     Nome:
                  </p>
                  <input class="uk-input" name="nome" maxlength="399" type="text"></div>
                  <div class="uk-margin w535">
                     <p class="title_form">
                        Password:
                     </p>
                     <input class="uk-input" name="password" maxlength="399" type="password"></div>
                     <div class="uk-margin w535">
                        <p class="title_form uk-margin-top">
                           Servidor de e-mail:
                        </p>
                        <input class="uk-input" name="servidor" maxlength="399" type="text"></div>
                        <div class="uk-margin w535">
                           <p class="title_form uk-margin-top">
                              Porta de e-mail:
                           </p>
                           <input class="uk-input" name="porta" maxlength="5" type="number"></div>
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
            
