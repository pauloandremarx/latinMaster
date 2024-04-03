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


class Post extends BaseController

{
    private $title = 'Latin Master - Administrador';

    protected $render;
    protected $container;

    private $validate;
    private $posts;


    // Injetar o serviço de renderização no construtor
    public function __construct($render, $container)
    {
        parent::__construct($render);
        $this->container = $container;
        $this->validate = new Validate();
        // Armazena o container na propriedade
    }

    public function index(Request $request, Response $response, array $args): Response

    {
        $this->posts = ReadQuery::select('*') // Seleciona todos os campos
            ->from('posts') // Da tabela 'post'
            ->get()->rows;


        $currentPath = $request->getUri()->getPath();


        // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'posts/index', [
            'title' => $this->title . ' - Postagem',
            'currentPath' => $currentPath,
            'posts' => $this->posts
        ]);
    }



    private function validateInput($data, $files)
    {
        
        $this->validate->required(['title', 'description', 'published'])
            ->in('published', ['0', '1'], 'Estado inválido');


        if ($this->validate->getErrors()) {
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
            return ($this->render)($response, 'posts/create', [
                'title' => $this->title . ' - Postagem',
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
                return redirect($response, $this->path_for($request, 'post.create'));
            }

            // Tente processar o upload das imagens e inserção no banco de dados
            try {
                if ($this->processImagesAndInsert($data, $files)) {
                    Flash::set('message', 'Banner criado com sucesso!', 'success');
                    return redirect($response, $this->path_for($request, 'posts'));
                } else {
                    Flash::set('message', 'Erro desconhecido ao criar o banner.', 'danger');
                    return redirect($response, $this->path_for($request, 'post.create'));
                }
                return redirect($response, $this->path_for($request, 'post.create'));
            } catch (\Exception $e) {
                Flash::set('message', 'Erro ao inserir no banco de dados: ' . $e->getMessage(), 'danger');
                return redirect($response, $this->path_for($request, 'post.create'));
            }
        }

        // Método HTTP não suportado
        return $response->withStatus(405);
    }



    private function processImagesAndInsert($data, $files)
    {
        // Inicialização dos nomes de imagens
        $ThumbMailName = '';
        $BannerName = '';

        // Processa o upload da imagem de desktop
        // Verifica e processa o upload da imagem de desktop
        if (isset($files['thumb']) && !isset($_POST['apagar_img2']) )  {
            if ($files['thumb']->getError() === UPLOAD_ERR_OK) {
                $create_thumb = new Image('thumb'); // 'imagem' é o nome do campo no formulário de upload
                $create_thumb->size('thumb')->upload();
                $ThumbMailName = $create_thumb->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem desktop.', 'danger');
            }
        }

        // Verifica e processa o upload da imagem mobile
        if (isset($files['thumb']) && !isset($_POST['apagar_img']) )  {
            if ($files['banner']->getError() === UPLOAD_ERR_OK) {
                $create_banner = new Image('banner'); // 'imagem_mobile' é o nome do campo no formulário de upload
                $create_banner->size('banner')->upload();
                $BannerName = $create_banner->getName(); // Recupera o nome do arquivo de imagem após o upload
            } else {
                Flash::set('message', 'Erro ao validar os dados da imagem mobile.', 'danger');
            }
        }

        // Prepara os dados para inserção, incluindo os nomes das imagens
        try {
            // Prepara os dados para inserção, incluindo os nomes das imagens
            $insertData = [
                'thumb' => $ThumbMailName ?? '',
                'banner' => $BannerName ?? '',
                'title' => $data['title'],
                'description' => $data['description'],
                'conteudo' => $data['conteudo'],
                'published' => $data['published'],

            ];

            // Insere os dados no banco de dados
            // Esta é uma chamada genérica; substitua-a pela sua lógica de inserção real
            $result = InsertQuery::into('posts')->insert($insertData);

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
        $Id = $args['id']; // Supondo que o ID seja passado como parte da rota
        $currentPath = $request->getUri()->getPath();
        $method = $request->getMethod();

        // Buscar informações existentes do Post para preenchimento no formulário de edição
        if ($method == 'GET') {
            $exist = ReadQuery::select('*')->from('posts')->where('id', '=', $Id)->first()->register;

            if (!$exist) {
                Flash::set('message', 'Post não encontrado.', 'danger');
                return redirect($response,   $this->path_for($request, 'post'));
            }


          
            return ($this->render)($response, 'posts/edit', [
                'title' => $this->title . ' - Editar Postagem',
                'currentPath' => $currentPath,
                'post' => $exist
            ]);
        }

        // Processa os dados enviados para atualizar o post
        if ($method == 'POST') {

       


            $data = $request->getParsedBody();
            $files = $request->getUploadedFiles(); // Isso retorna um array de objetos UploadedFile

            // Validação dos dados do formulário e arquivos
            $validationResult = $this->validateInput($data, $files);
            if ($validationResult !== true) {
                Flash::set('message', $validationResult, 'danger');
                return redirect($response, $this->path_for($request, 'post.update', ['id' => $Id]));
            }

            // Tente processar a atualização das imagens e dos dados no banco de dados
            try {
                if ($this->processImagesAndUpdate($data, $files, $Id)) {
                    Flash::set('message', 'Post atualizado com sucesso!', 'success');
                    return redirect($response, $this->path_for($request, 'post.update', ['id' => $Id]));
                } else {
                    Flash::set('message', 'Erro desconhecido ao atualizar o post.', 'danger');
                    return redirect($response, $this->path_for($request, 'post.update', ['id' => $Id]));
                }
            } catch (\Exception $e) {
                Flash::set('message', 'Erro ao atualizar no banco de dados: ' . $e->getMessage(), 'danger');
                return redirect($response, $this->path_for($request, 'post.update', ['id' => $Id]));
            }
        }

        return redirect($response,   $this->path_for($request, 'post'));

        // Método HTTP não suportado
        return $response->withStatus(405);
    }

    private function processImagesAndUpdate($data, $files, $id)
    {
        $table = 'posts';
        // Obtém o registro atual do post do banco de dados como um objeto
        $current = ReadQuery::select('*')->from($table)->where('id', '=', $id)->first()->register;

        // Nomes de arquivo atuais, serão substituídos se novas imagens forem enviadas
        $update_thumbImageName = $current->thumb ?? '';
        $update_bannerImageName = $current->banner ?? '';
  

        if (isset($files['thumb']) && !isset($_POST['apagar_img2']) )  {
            // Verifica e processa a nova imagem de desktop, se fornecida  
            if (isset($files['thumb']) && $files['thumb']->getError() !== UPLOAD_ERR_NO_FILE) {
                if (!empty($update_thumbImageName)) {
                    $imagethumbDelete = new Image($update_thumbImageName);
                    $imagethumbDelete->deleteByName($update_thumbImageName);
                }

                if ($files['thumb']->getError() === UPLOAD_ERR_OK) {
                    $thumb = new Image('thumb'); // 'imagem' é o nome do campo no formulário de upload
                    $thumb->size('thumb')->upload();
                    $update_thumbImageName = $thumb->getName(); // Recupera o nome do arquivo de imagem após o upload
                } else {
                    Flash::set('message', 'Erro ao validar os dados da imagem desktop.', 'danger');
                }
            }
        }

        if (isset($files['banner']) && !isset($_POST['apagar_img'])  ) {
            // Verifica e processa a nova imagem mobile, se fornecida
            if (isset($files['banner']) && $files['banner']->getError() !== UPLOAD_ERR_NO_FILE) {

                if (!empty($update_bannerImageName)) {
                    $imagebannerDelete = new Image($update_bannerImageName);
                    $imagebannerDelete->deleteByName($update_bannerImageName);
                }

                if ($files['banner']->getError() === UPLOAD_ERR_OK) {
                    $banner = new Image('banner'); // 'imagem_mobile' é o nome do campo no formulário de upload
                    $banner->size('banner')->upload();
                    $update_bannerImageName = $banner->getName(); // Recupera o nome do arquivo de imagem após o upload
                } else {
                    Flash::set('message', 'Erro ao validar os dados da imagem mobile.', 'danger');
                }
            }
        }

        // Prepara os dados para atualização
        try {

            $updateData = [
                'thumb' => $ThumbMailName ?? '',
                'banner' => $BannerName ?? '',
                'title' => $data['title'],
                'description' => $data['description'],
                'conteudo' => $data['conteudo'],
                'published' => $data['published'],

            ];

            // Atualiza os dados no banco de dados
            UpdateQuery::table($table)
                ->where('id', '=', $id)
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

        $table = 'posts';

        $Id = intval(strip_tags($_POST['id']));

        // Verifica se o posts existe antes de tentar deletá-lo
        $Exists = ReadQuery::select('*')->from($table)->where('id', '=', $Id)->first()->register;

        if (!$Exists) {
            // Se o post não existe, redireciona com uma mensagem de erro
            Flash::set('message', 'Post não encontrado.', 'danger');
            return redirect($response, $this->path_for($request, 'post'));
        }

        // Exclui a imagem de desktop
        if (!empty($Exists->thumb)) {
            $thumbInstance = new  Image($Exists->thumb);
            $thumbInstance->deleteByName($Exists->thumb);
        }

        // Exclui a imagem mobile
        if (!empty($Exists->banner)) {
            $bannerInstance = new  Image($Exists->banner);
            $bannerInstance->deleteByName($Exists->banner);
        }

        // Se o post existe, prossegue com a operação de delete
        try {
            DeleteQuery::table($table)->where('id', '=', $Id)->delete();
            Flash::set('message', 'Post do id ' . $Id . ' e suas imagens foram excluídos com sucesso.', 'success');
            return redirect($response, $this->path_for($request, 'posts'));
        } catch (\Exception $e) {
            // Em caso de erro na operação de delete, captura a exceção e define uma mensagem de erro
            Flash::set('message', 'Erro ao excluir o posts e/ou imagens.', 'danger');
        }

        // Redireciona para a lista de posts
        return redirect($response, $this->path_for($request, 'post'));
    }
}
