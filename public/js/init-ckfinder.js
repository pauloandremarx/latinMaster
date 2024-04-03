const editorElement = document.getElementById('editor');
if (editorElement) {
    // Configuração do CKEditor
    ClassicEditor
        .create(editorElement, {
            
            ckfinder: {
                // Use o método path_for() para obter a URL da rota nomeada no Slim Framework
                uploadUrl: '{{ path_for('upload_img') }}', // Substitua 'upload_img' pelo nome da rota
                // Configurações do CKFinder
                options: {
                    resourceType: 'Images', // Tipo de recurso permitido para upload (Imagens, Arquivos, etc.)
                    // Configuração do modal de upload de imagem
                    upload: {
                        // Configuração da janela de upload
                        maxFileSize: 20 * 1024 * 1024, // Tamanho máximo do arquivo em bytes (20MB neste exemplo)
                        multiple: false, // Permite o upload de vários arquivos de uma vez
                        // Outras configurações do modal de upload conforme necessário
                    }
                }
            },
            // Configurações adicionais do CKEditor
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'imageUpload',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            language: 'pt-br' // Define o idioma para Português do Brasil
        })
        .then(editor => {
            window.editor = editor; // Atribui o editor à variável global window.editor, se necessário
        })
        .catch(error => {
            console.error('Oops, something went wrong!');
            console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
            console.warn('Build id: stt8cqaqxijp-730qcm9nubkc');
            console.error(error);
        });
}
 
 