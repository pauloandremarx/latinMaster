<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;
use app\database\builder\InsertQuery;
use app\database\builder\DeleteQuery;
use app\database\builder\UpdateQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use app\classes\Validate;
use app\classes\Image;
use app\classes\Flash;

class Slider extends BaseController

{
    private $title = 'Latin Master - Administrador';

    protected $render;
    protected $container;

    private $validate;
    private $posts;
    private $sliders;

    // Injetar o serviço de renderização no construtor
    public function __construct($render, $container)
    {
        parent::__construct($render);
        $this->container = $container;
        // Armazena o container na propriedade
    }

    public function index(Request $request, Response $response, array $args): Response

    {
        $this->sliders = ReadQuery::select('*') // Seleciona todos os campos
            ->from('slider') // Da tabela 'post'
            ->get();

        /*
        var_dump( $this->sliders);
        exit;*/

        $currentPath = $request->getUri()->getPath();


        // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'banners/index', [
            'title' => $this->title . ' - Banner',
            'currentPath' => $currentPath,
            'sliders' => $this->sliders->rows
        ]);
    }


    private function validateInput($data, $files)
    {
        $validate = new Validate();
        $validate->required(['url', 'ordem', 'ativo'])
            ->number('ordem', $data['ordem'] ?? '')
            ->in('ativo', ['0', '1'], 'Estado inválido');


        if ($validate->getErrors()) {
            Flash::set('message', 'Erro ao validar os  dados: ', 'danger');
            return false;
        } else {
            return true;
        }
    }


    public function create(Request $request, Response $response, array $args)
    {
        $currentPath = $request->getUri()->getPath();
        $method = $request->getMethod();

        // Serve o formulário para o usuário no método GET
        if ($method == 'GET') {
            return ($this->render)($response, 'banners/create', [
                'title' => $this->title . ' - Banner',
                'currentPath' => $currentPath,
                
            ]);
        }

        // Lógica de processamento para o método POST
        if ($method == 'POST') {
            $data = $request->getParsedBody();
            $files = $request->getUploadedFiles(); // Isso retorna um array de objetos UploadedFile

            // Validação dos dados do formulário e arquivos
            $validationResult = $this->validateInput($data, $files);
            if ($validationResult !== true) {
                Flash::set('message', $validationResult, 'danger');
                return redirect($response, $this->path_for($request, 'slider.create'));
            }

            // Tente processar o upload das imagens e inserção no banco de dados
            try {
                if ($this->processImagesAndInsert($data, $files)) {
                    Flash::set('message', 'Banner criado com sucesso!', 'success');
                    return redirect($response, $this->path_for($request, 'slider'));
                } else {
                    Flash::set('message', 'Erro desconhecido ao criar o banner.', 'danger');
                    return redirect($response, $this->path_for($request, 'slider.create'));
                }
                return redirect($response, $this->path_for($request, 'slider.create'));
            } catch (\Exception $e) {
                Flash::set('message', 'Erro ao inserir no banco de dados: ' . $e->getMessage(), 'danger');
                return redirect($response, $this->path_for($request, 'slider.create'));
            }
        }

        // Método HTTP não suportado
        return $response->withStatus(405);
    }



    private function processImagesAndInsert($data, $files)
    {
        // Inicialização dos nomes de imagens
        $desktopImageName = '';
        $mobileImageName = '';

        // Processa o upload da imagem de desktop
        // Verifica e processa o upload da imagem de desktop
        if (isset($files['imagem'])) {
            if ($files['imagem']->getError() === UPLOAD_ERR_OK) {
                $create_image = new Image('imagem'); // 'imagem' é o nome do campo no formulário de upload
                $create_image->size('slider_desktop')->upload();
                $desktopImageName = $create_image->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem desktop.', 'danger');
            }
        }

        // Verifica e processa o upload da imagem mobile
        if (isset($files['imagem_mobile'])) {
            if ($files['imagem_mobile']->getError() === UPLOAD_ERR_OK) {
                $create_image_mobile = new Image('imagem_mobile'); // 'imagem_mobile' é o nome do campo no formulário de upload
                $create_image_mobile->size('slider_mobile')->upload();
                $mobileImageName = $create_image_mobile->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem mobile.', 'danger');
            }
        }

        // Prepara os dados para inserção, incluindo os nomes das imagens
        try {
            // Prepara os dados para inserção, incluindo os nomes das imagens
            $insertData = [
                'imagem' => $desktopImageName ?? '',
                'imagem_mobile' => $mobileImageName ?? '',
                'legenda' => $data['url'],
                'ordem' => $data['ordem'],
                'ativo' => $data['ativo'],
            ];

            // Insere os dados no banco de dados
            // Esta é uma chamada genérica; substitua-a pela sua lógica de inserção real
            $result = InsertQuery::into('slider')->insert($insertData);

            // Define uma mensagem de sucesso
            Flash::set('message', 'Dados inseridos com sucesso!', 'success');

            return true;
            // Retorna um status HTTP 200 explicitamente, se necessário


            // Aqui você pode redirecionar o usuário ou fazer outra ação de sucesso
            // Por exemplo: header('Location: pagina_de_sucesso.php');
            // Não se esqueça do exit após um redirecionamento para encerrar a execução do script
            // exit;
        } catch (\Exception $e) {
            // Define uma mensagem de erro se a inserção falhar
            Flash::set('message', 'Erro ao inserir os dados no banco de dados: ' . $e->getMessage(), 'danger');
            // Retorna um status HTTP 500 para indicar erro de servidor 
            return false;
        }
    }




    public function update(Request $request, Response $response, array $args)
    {
        $sliderId = $args['id'];
        $currentPath = $request->getUri()->getPath();
        $method = $request->getMethod();
    
        // Busca inicial do slider para verificar existência
        $slider = ReadQuery::select('*')->from('slider')->where('id', '=', $sliderId)->first()->register;

        if (!$slider) {
            // Redireciona com erro se o slider não for encontrado em qualquer método HTTP
            Flash::set('message', 'Slider não encontrado.', 'danger');
            return redirect($response, $this->path_for($request, 'slider'));
        }
    
        if ($method == 'GET') {
            // Renderiza o formulário de edição para método GET
            return ($this->render)($response, 'banners/edit', [
                'title' => $this->title . ' - Editar Banner',
                'currentPath' => $currentPath,
                'slider' => $slider
            ]);
        } elseif ($method == 'POST') {
            // Processa a atualização para método POST
            $data = $request->getParsedBody();
            $files = $request->getUploadedFiles();
            $validationResult = $this->validateInput($data, $files);
            if ($validationResult !== true) {
                Flash::set('message', $validationResult, 'danger');
                return redirect($response, $this->path_for($request, 'slider.update', ['id' => $sliderId]));
            }
    
            try {
                if ($this->processImagesAndUpdate($data, $files, $sliderId)) {
                    Flash::set('message', 'Slider atualizado com sucesso!', 'success');
                } else {
                    throw new \Exception('Erro desconhecido ao atualizar o slider.');
                }
            } catch (\Exception $e) {
                Flash::set('message', 'Erro ao atualizar no banco de dados: ' . $e->getMessage(), 'danger');
            }
            return redirect($response, $this->path_for($request, 'slider.update', ['id' => $sliderId]));
        } else {
            // Método HTTP não suportado
            return redirect($response, $this->path_for($request, 'error', ['routes' => 'url-nao-encontrada']));
        }
    }
    

    private function processImagesAndUpdate($data, $files, $sliderId)
    {
        // Obtém o registro atual do slider do banco de dados como um objeto
        $currentSlider = ReadQuery::select('*')->from('slider')->where('id', '=', $sliderId)->first()->register;

        // Nomes de arquivo atuais, serão substituídos se novas imagens forem enviadas
        $update_desktopImageName = $currentSlider->imagem ?? '';
        $update_mobileImageName = $currentSlider->imagem_mobile ?? ''; 

      
        // Verifica e processa a nova imagem de desktop, se fornecida  
        if (isset($files['imagem']) && $files['imagem']->getError() !== UPLOAD_ERR_NO_FILE) {
            if (!empty($update_desktopImageName)) {
                $imageDelete = new Image($update_desktopImageName);
                $imageDelete->deleteByName($update_desktopImageName);
            }

            if ($files['imagem']->getError() === UPLOAD_ERR_OK) {
                $image = new Image('imagem'); // 'imagem' é o nome do campo no formulário de upload
                $image->size('slider_desktop')->upload();
                $update_desktopImageName = $image->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem desktop.', 'danger');
            }
        }
      
        // Verifica e processa a nova imagem mobile, se fornecida
        if (isset($files['imagem_mobile']) && $files['imagem_mobile']->getError() !== UPLOAD_ERR_NO_FILE) {

            if (!empty($update_mobileImageName)) {
                $imageMobileDelete = new Image($update_mobileImageName);
                $imageMobileDelete->deleteByName($update_mobileImageName);
            }

            if ($files['imagem_mobile']->getError() === UPLOAD_ERR_OK) {
                $imagem_mobile = new Image('imagem_mobile'); // 'imagem_mobile' é o nome do campo no formulário de upload
                $imagem_mobile->size('slider_mobile')->upload();
                $update_mobileImageName = $imagem_mobile->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem mobile.', 'danger');
            }
        }

        // Prepara os dados para atualização
        try {
            $updateData = [
                'imagem' => $update_desktopImageName, // Certifique-se de que estas variáveis estão definidas corretamente
                'imagem_mobile' => $update_mobileImageName,
                'legenda' => $data['url'],
                'ordem' => $data['ordem'],
                'ativo' => $data['ativo'],
            ];
            
            // Atualiza os dados no banco de dados
            $result = UpdateQuery::table('slider')
                ->where('id', '=', $sliderId)
                ->set($updateData)
                ->update();

            return true;
        } catch (\Exception $e) {
            // Em caso de erro
            return false;
           
        }
    }





    public function delete(Request $request, Response $response, array $args): Response
    {
        $Id = intval(strip_tags($_POST['id']));

        // Verifica se o slider existe antes de tentar deletá-lo
        $Exists = ReadQuery::select('*')->from('slider')->where('id', '=', $Id)->first()->register;

        if (!$Exists) {
            // Se o slider não existe, redireciona com uma mensagem de erro
            Flash::set('message', 'Slider não encontrado.', 'danger');
            return redirect($response, $this->path_for($request, 'slider'));
        }

        // Exclui a imagem de desktop
        if (!empty($Exists->imagem)) {
            $imageInstance = new  Image($Exists->imagem);
            $imageInstance->deleteByName($Exists->imagem);
        }

        // Exclui a imagem mobile
        if (!empty($Exists->imagem_mobile)) {
            $image_mobileInstance = new  Image($Exists->imagem_mobile);
            $image_mobileInstance->deleteByName($Exists->imagem_mobile);
        }

        // Se o slider existe, prossegue com a operação de delete
        try {
            DeleteQuery::table('slider')->where('id', '=', $Id)->delete();
            Flash::set('message', 'Slider do id ' . $Id . ' e suas imagens foram excluídos com sucesso.', 'success');
            return redirect($response, $this->path_for($request, 'slider'));
        } catch (\Exception $e) {
            // Em caso de erro na operação de delete, captura a exceção e define uma mensagem de erro
            Flash::set('message', 'Erro ao excluir o slider e/ou imagens.', 'danger');
        }

        // Redireciona para a lista de sliders
        return redirect($response, $this->path_for($request, 'slider'));
    }
}
