<?php

namespace app\classes;

class Flash
{
    public static function set($key, $message, $alert = 'success')
    {
        if (!isset($_SESSION['messages'][$key])) {
            $_SESSION['messages'][$key] = [
                'message' => $message,
                'alert' => $alert
            ];
        }
    }

    public static function get($key)
    {
        if (isset($_SESSION['messages'][$key])) {
            $flash = $_SESSION['messages'][$key];
            unset($_SESSION['messages'][$key]); // Certifique-se de remover a mensagem após o acesso para evitar duplicação.

            return $flash;
        }

        return null; // Retorna nulo ou uma string vazia se a chave não existir.
    }

    public static function flashes(array $flashes)
    {
        foreach ($flashes as $key => $message) {
            self::set($key, $message, 'danger');
        }
    }

    public static function getAll()
    {
        if (isset($_SESSION['messages'])) {
            $messages = [];
            foreach ($_SESSION['messages'] as $key => $message) {
                $messages['messages'][$key] = $message;
                unset($_SESSION['messages'][$key]);
            }

            return $messages['messages'] ?? [];
        }
    }
}
