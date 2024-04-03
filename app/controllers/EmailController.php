<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;

use app\database\builder\UpdateQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use app\classes\Validate;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use app\classes\Flash;

 

class EmailController extends BaseController

{
    private $title = 'Latin Master';

    protected $render;
    protected $container;

    private $validate;
    private $posts;
    private $sliders;

    private $smtp_host;
    private $smtp_user;
    private $smtp_pass;
    private $smtp_port;
    private $smtp_secure;
    private $mail_from;
    private $mail_from_name;

    // Injetar o serviço de renderização no construtor
    public function __construct($render, $container)
    {
        parent::__construct($render);
        $this->container = $container;
        // Armazena o container na propriedade

        $this->smtp_host = $_ENV['SMTP_HOST'];
        $this->smtp_user = $_ENV['SMTP_USER'];
        $this->smtp_pass = $_ENV['SMTP_PASS'];
        $this->smtp_port = $_ENV['SMTP_PORT'];
        $this->smtp_secure = $_ENV['SMTP_SECURE'];
        $this->mail_from = $_ENV['MAIL_FROM'];
        $this->mail_from_name = $_ENV['MAIL_FROM_NAME'];
    }

    public function index(Request $request, Response $response, array $args): Response

    {
        $this->posts = ReadQuery::select('*') // Seleciona todos os campos
            ->from('posts') // Da tabela 'post'
            ->get()->rows;

        $this->sliders = ReadQuery::select('*') // Seleciona todos os campos
            ->from('slider') // Da tabela 'post'
            ->get();

        $url = $this->path_for($request, 'home', ['param1' => 'valor1', 'param2' => 'valor2']);

        $currentPath = $request->getUri()->getPath();


        // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'home', [
            'title' => $this->title . ' - Home',
            'posts' =>  $this->posts,
            'currentPath' => $currentPath,
            'sliders' => $this->sliders
        ]);
    }

    public function sendEmail(Request $request, Response $response, $args)
    {
        $data = (array)$request->getParsedBody();

        // Criando o corpo do e-mail com os dados do formulário
        $body = "Dados do Cliente - Latin Master\n\n";
        $body .= "Nome: " . htmlspecialchars($data['name']) . "\n";
        $body .= "Empresa: " . htmlspecialchars($data['empresa']) . "\n";
        $body .= "Telefone: " . htmlspecialchars($data['tel']) . "\n";
        $body .= "E-mail: " . htmlspecialchars($data['email']) . "\n";
        $body .= "Departamento: " . htmlspecialchars($data['departamento']) . "\n";
        $body .= "Mensagem:\n" . htmlspecialchars($data['mensagem']);

        $email = new PHPMailer(true);

        try {
            // Configuração do servidor de e-mail
            $email->isSMTP();
            $email->Host = $this->smtp_host;
            $email->SMTPAuth = true;
            $email->Username = $this->smtp_user;
            $email->Password = $this->smtp_pass;
            $email->SMTPSecure = $this->smtp_secure;
            $email->Port = $this->smtp_port;

            // Configurações do remetente e destinatário
            $email->setFrom($this->mail_from, $this->mail_from_name);
            // Substitua 'email-destino@example.com' pelo e-mail onde você deseja receber as mensagens
            $email->addAddress('info@latinmaster.com.b', 'Latin Master');

            // Definindo o formato do e-mail para HTML
            $email->isHTML(true);
            $email->Subject = 'Dados do Cliente - Latin Master';
            $email->Body    = nl2br($body); // Converte quebras de linha em <br> para o formato HTML
            $email->AltBody = $body; // Texto alternativo sem HTML

            $email->send();
            $response->getBody()->write('Email enviado com sucesso.');
            return $response->withStatus(200);
        } catch (Exception $e) {
            $response->getBody()->write("Erro ao enviar e-mail: {$email->ErrorInfo}");
            return $response->withStatus(500);
        }
    }


        public function sendForgotPasswordEmail(Request $request, Response $response, $args)
    { 
        
        $exist = ReadQuery::select('*')->from('users')->where('id', '=', 0)->first()->register; 
        $emailTo = $exist->email;


        function generateRandomPassword($length = 12) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
            $charactersLength = strlen($characters);
            $randomPassword = '';
            for ($i = 0; $i < $length; $i++) {
                $randomPassword .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomPassword;
        }

        $newPassword = generateRandomPassword();
        // Presume-se que você tenha uma forma de identificar o usuário unicamente, como um e-mail ou ID
        UpdateQuery::table('users') // Nome da tabela onde a senha será atualizada
        ->set(['password' => password_hash($newPassword, PASSWORD_DEFAULT)]) // Sempre hash a senha antes de salvá-la no banco de dados
        ->where("email", "=", $emailTo) // Condição para encontrar o usuário correto
        ->update();
 

        // Criando o corpo do e-mail
        $body = "Olá,\n\n";
        $body .= "Você solicitou a redefinição de sua senha na Latin Master.\n\n";
        $body .= "Sua nova senha é: " . htmlspecialchars($newPassword) . "\n\n";
        $body .= "Recomendamos que você altere esta senha assim que acessar sua conta.\n\n";
        $body .= "Atenciosamente,\n";
        $body .= "Equipe Latin Master";

        $email = new PHPMailer(true);

        try {
            // Configuração do servidor de e-mail
            $email->isSMTP();
            $email->Host = $this->smtp_host;
            $email->SMTPAuth = true;
            $email->Username = $this->smtp_user;
            $email->Password = $this->smtp_pass;
            $email->SMTPSecure = $this->smtp_secure;
            $email->Port = $this->smtp_port;

            // Configurações do remetente e destinatário
            $email->setFrom($this->mail_from, $this->mail_from_name);
            $email->addAddress($emailTo); // E-mail do destinatário

            // Definindo o formato do e-mail para HTML
            $email->isHTML(true);
            $email->Subject = 'Redefinição de Senha - Latin Master';
            $email->Body    = nl2br($body); // Converte quebras de linha em <br> para o formato HTML
            $email->AltBody = $body; // Texto alternativo sem HTML

            $email->send();
        
            return redirect($response, $this->path_for($request, 'login')); 
            Flash::set('message', 'E-mail de redefinição de senha enviado com sucesso', 'sucess');
        } catch (Exception $e) {
            return redirect($response, $this->path_for($request, 'login')); 
            Flash::set('message', 'E-mail de redefinição de senha ocorreu um erro, tente novamente mais tarde.', 'danger');
        }

        
    }

    
}
