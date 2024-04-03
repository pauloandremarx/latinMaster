{% extends "layouts/layout.twig" %}
{% block content %}
   <section class="bg_formularios_c">
      <div class="uk-container" uk-height-viewport="expand: true">
         <div class="uk-grid uk-margin-top">
            <div class="uk-width-1-2@m uk-flex uk-flex-left">
               <a href="{{ path_for('admin') }}" class="voltar-btn">
                  Voltar
               </a>
            </div>
            <div class="uk-width-1-2@m uk-flex uk-flex-right">
               {% if servidores|length == 0 %}
                  <a class="adcionar-btn" href="{{ path_for('servidor.create') }}">
                     Adicionar um servidor de e-mail
                  </a>
               {% endif %}
            </div>
         </div>
         <div>
            <h1 class="admin-item-title">
               Servidor de e-mail:
            </h1>
         </div>
         <div class="uk-grid uk-margin-medium-top">
            {% for servidor in servidores %}
               <div class="uk-margin-medium-bottom uk-width-1-3@m dark-card">
                  <div class="uk-card uk-card-default">
                     <div class="uk-card-body">
                        <p class="">
                           {{ servidor.nome }}
                        </p>
                        <p class="">
                           {{ servidor.email }}
                        </p>
                        <p class="uk-text-meta uk-margin-remove-top">
                           Criado: 
                           <time datetime="2016-04-01T19:00">
                              {{ servidor.created_at | date('d/m/Y H:i:s') }}
                           </time>
                        </p>
                     </div>
                     <div class="uk-card-footer">
                        <div class="uk-grid uk-child-width-1-2">
                           <div>
                              <a href="{{ path_for('servidor.edit', {'id': servidor.id }) }}">
                                 <button class="uk-button uk-button-default">
                                    Editar
                                 </button>
                              </a>
                           </div>
                           <div>
                              <button type="button" uk-toggle="target: #modal-apagar{{ servidor.id }}" class="uk-button uk-button-danger">
                                 Apagar
                              </button>
                           </div>
                        </div>
                     </div>
                     <!-- This is the modal -->
                     <div id="modal-apagar{{ servidor.id }}" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                           <p class="uk-text-danger uk-text-center">
                              Tem certeza que deseja apagar?
                           </p>
                           <div class="uk-modal-footer uk-text-center">
                              <button class="uk-button uk-button-default uk-modal-close" type="button">
                                 Cancelar
                              </button>
                              <a href="{{ path_for('servidor.delete') }}?id={{ servidor.id }}">
                                 <button class="uk-button uk-button-danger" type="button">
                                    Apagar
                                 </button>
                              </a>
                              <div></div>
                           </div>
                        <!-- modal final -->
                        </div>
                     </div>
                  </div>
               </div>
            {% endfor %}
         </div>
         <hr>
            <div>
               <h1 class="admin-item-title">
                  Copias de e-mail:
               </h1>
            </div>
            <div class="uk-width-1-1 uk-flex uk-flex-right">
               <a class="adcionar-btn" href="{{ path_for('com_copia.create') }}">
                  Adicionar copia de e-mail
               </a>
            </div>
            <div class="uk-grid uk-margin-medium-top">
               {% for com_copia in com_copias %}
                  <div class="uk-margin-medium-bottom uk-width-1-3@m dark-card">
                     <div class="uk-card uk-card-default">
                        <div class="uk-card-body">
                           <p class="">
                              {{ com_copia.nome }}
                           </p>
                           <p class="">
                              {{ com_copia.email }}
                           </p>
                           <p class="uk-text-meta uk-margin-remove-top">
                              Criado: 
                              <time datetime="2016-04-01T19:00">
                                 {{ com_copia.created_at | date('d/m/Y H:i:s') }}
                              </time>
                           </p>
                        </div>
                        <div class="uk-card-footer">
                           <div class="uk-grid uk-child-width-1-2">
                              <div>
                                 <a href="{{ path_for('com_copia.edit', {'id': com_copia.id }) }}">
                                    <button class="uk-button uk-button-default">
                                       Editar
                                    </button>
                                 </a>
                              </div>
                              <div>
                                 <button type="button" uk-toggle="target: #modal-apagar{{ com_copia.id }}" class="uk-button uk-button-danger">
                                    Apagar
                                 </button>
                              </div>
                           </div>
                        </div>
                        <!-- This is the modal -->
                        <div id="modal-apagar{{ com_copia.id }}" uk-modal>
                           <div class="uk-modal-dialog uk-modal-body">
                              <p class="uk-text-danger uk-text-center">
                                 Tem certeza que deseja apagar?
                              </p>
                              <div class="uk-modal-footer uk-text-center">
                                 <button class="uk-button uk-button-default uk-modal-close" type="button">
                                    Cancelar
                                 </button>
                                 <a href="{{ path_for('com_copia.delete') }}?id={{ com_copia.id }}">
                                    <button class="uk-button uk-button-danger" type="button">
                                       Apagar
                                    </button>
                                 </a>
                                 <div></div>
                              </div>
                           <!-- modal final -->
                           </div>
                        </div>
                     </div>
                  </div>
               {% endfor %}
            </div>
         </div>
      </section>
   {% endblock content %}
   
