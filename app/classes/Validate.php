<?php

namespace app\classes;

use Carbon\Carbon;

class Validate
{
    private $errors = [];

    public function required(array $fields)
    {
        foreach ($fields as $field) {
            // Usa trim() para remover espaços em branco do início e do fim da string antes de verificar se está vazia
            if (empty(trim($_POST[$field]))) {
                Flash::set($field, "O campo {$field} é obrigatório", 'danger');
                $this->errors[$field] = true;
            } else {
                // Ainda usa trim() aqui para garantir que os dados salvos não contenham espaços desnecessários no início/fim
                Flash::set('old_' . $field, trim($_POST[$field]));
            }
        }
    
        return $this;
    }
    

    public function exist($model, $field, $value)
    {
        $data = $model->findBy($field, $value);

        if ($data) {
            Flash::set($field, "O valor para {$field} já está cadastrado no banco de dados", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $_POST[$field]);
        }

        return $this;
    }

    public function email($field, $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flash::set($field, "O campo {$field} deve conter um endereço de e-mail válido", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $email);
        }

        return $this;
    }

    public function minLength($field, $value, $min)
    {
        if (strlen($value) < $min) {
            Flash::set($field, "O campo {$field} deve ter pelo menos {$min} caracteres", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $value);
        }

        return $this;
    }

    public function maxLength($field, $value, $max)
    {
        if (strlen($value) > $max) {
            Flash::set($field, "O campo {$field} deve ter no máximo {$max} caracteres", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $value);
        }

        return $this;
    }

    public function number($field, $value)
    {
        if (!is_numeric($value)) {
            Flash::set($field, "O campo {$field} deve ser um número", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $value);
        }

        return $this;
    }


    public function match($field1, $field2, $message = null)
    {
        if ($_POST[$field1] !== $_POST[$field2]) {
            // Define a mensagem aqui, se uma mensagem personalizada não foi fornecida.
            if ($message === null) {
                $message = "Os campos {$field1} e {$field2} não coincidem";
            }

            Flash::set($field1, $message, 'danger');
            Flash::set($field2, $message, 'danger');
            $this->errors[$field1] = true;
            $this->errors[$field2] = true;
        } else {
            Flash::set('old_' . $field1, $_POST[$field1]);
            Flash::set('old_' . $field2, $_POST[$field2]);
        }
        return $this;
    }


    public function url($field, $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            Flash::set($field, "O campo {$field} deve ser uma URL válida", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $url);
        }
        return $this;
    }

    public function in($field, array $allowedValues, $message = "Valor inválido")
    {
        if (!isset($_POST[$field]) || !in_array($_POST[$field], $allowedValues)) {
            Flash::set($field, $message, 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $_POST[$field]);
        }

        return $this;
    }


    public function integer($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            Flash::set($field, "O campo {$field} deve ser um inteiro", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $value);
        }
        return $this;
    }

    public function range($field, $value, $min, $max)
    {
        if (!is_numeric($value) || $value < $min || $value > $max) {
            Flash::set($field, "O campo {$field} deve estar entre {$min} e {$max}", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $value);
        }
        return $this;
    }

    public function date($field, $date, $format = 'Y-m-d')
    {
        $d = Carbon::createFromFormat($format, $date);
        if (!$d || $d->format($format) !== $date) {
            Flash::set($field, "O campo {$field} deve ser uma data válida no formato {$format}", 'danger');
            $this->errors[$field] = true;
        } else {
            Flash::set('old_' . $field, $date);
        }
        return $this;
    }





    public function regex($field, $value, $pattern, $message = "Formato inválido")
    {
        Flash::set('old_' . $field, $value);
        if (!preg_match($pattern, $value)) {
            Flash::set($field, "{$field}: {$message}", 'danger');
            $this->errors[$field] = true;
        }
        return $this;
    }

    public function alphanumeric($field, $value, $message = "Apenas caracteres alfanuméricos são permitidos")
    {
        Flash::set('old_' . $field, $value);
        if (!ctype_alnum($value)) {
            Flash::set($field, "{$field}: {$message}", 'danger');
            $this->errors[$field] = true;
        }
        return $this;
    }

    public function fileExists($fieldName, $message = 'Arquivo não carregado')
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            Flash::set($fieldName, "{$fieldName}: {$message}", 'danger');
            $this->errors[$fieldName] = true;
        }
        return $this;
    }

    public function fileSize($fieldName, $maxSize, $message = 'Arquivo excede o tamanho máximo permitido')
    {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['size'] > $maxSize) {
            Flash::set($fieldName, "{$fieldName}: {$message}", 'danger');
            $this->errors[$fieldName] = true;
        }
        return $this;
    }

    public function fileType($fieldName, array $allowedTypes, $message = 'Tipo de arquivo não permitido')
    {
        if (isset($_FILES[$fieldName]) && !in_array($_FILES[$fieldName]['type'], $allowedTypes)) {
            Flash::set($fieldName, "{$fieldName}: {$message}", 'danger');
            $this->errors[$fieldName] = true;
        }
        return $this;
    }

    public function imageValid($fieldName, $message = 'Arquivo não é uma imagem válida ou está corrompida')
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            Flash::set($fieldName, "{$fieldName}: {$message}", 'danger');
            $this->errors[$fieldName] = true;
        } else {
            $tmpName = $_FILES[$fieldName]['tmp_name'];
            if (!empty($tmpName) && !getimagesize($tmpName)) {
                Flash::set($fieldName, "{$fieldName}: {$message}", 'danger');
                $this->errors[$fieldName] = true;
            }
        }
        return $this;
    }
    


    public function getErrors()
    {
        return !empty($this->errors);
    }
}
