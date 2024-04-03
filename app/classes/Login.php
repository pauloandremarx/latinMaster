<?php

namespace app\classes;

use app\database\models\User;
use app\classes\Flash; // Supondo que você tenha uma classe Flash para gerenciar as mensagens de sessão

class Login
{
    public function login($email, $password)
    {

        $user = new User;
        $userFound = (object)$user->findBy('email', $email);

      

        // Verifica se a propriedade 'scalar' existe e é false.
        if (isset($userFound->scalar) && $userFound->scalar === false) {
            Flash::set('message', 'Nenhum usuário encontrado com esse e-mail.', 'danger');
            return false;
        }

        if (!password_verify($password, $userFound->password)) {
            Flash::set('message', 'Senha incorreta.', 'danger');
            return false;
        }

        $_SESSION['is_logged_in'] = [
            'name' => $userFound->name,
            'email' => $userFound->email,
        ];

        return true;
    }

    public function logout()
    {
        unset($_SESSION['is_logged_in']);
        session_destroy();
    }
}
