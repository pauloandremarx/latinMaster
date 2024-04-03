<?php

namespace app\database\builder;

use app\database\Connection;

abstract class Builder
{
    protected array $binds = [];
    protected array $where = [];
    protected array $query = [];

    protected function getConnection()
    {
        return Connection::getConnection();
    }

    public function where(string $field, string $operator, string|int $value, ?string $logic = null)
    {
        $fieldPlaceholder = $field;

        if (str_contains($fieldPlaceholder, '.')) {
            $fieldPlaceholder = str_replace('.', '', $fieldPlaceholder);
        }

        $this->where[] = "{$field} {$operator} :{$fieldPlaceholder} {$logic}";

        $this->binds[$fieldPlaceholder] = strip_tags($value);

        return $this;
    }


    protected function executeQuery($query, $returnExecute = false)
    {
        $connection = $this->getConnection();

        if (!$connection) {
            // Se a conexão com o banco de dados não estiver disponível, retornar um valor padrão
            return null;
        }

        try {
            $prepare = $connection->prepare($query);
            $execute = $prepare->execute($this->binds ?? []);
            return ($returnExecute) ? $execute : $prepare;
        } catch (\PDOException $th) {
            // Verifica se o código de erro é específico para "tabela não encontrada"
            if ($th->getCode() === '42S02') {
                // Aqui você pode personalizar sua mensagem de erro ou tratamento
                throw new \Exception("Erro: A tabela especificada não existe no banco de dados. Detalhes: " . $th->getMessage());
            } else {
                // Para todos os outros erros, você pode optar por tratar de forma genérica
                // ou lançar a exceção original para ser tratada por uma lógica de erro mais abrangente.
                throw $th; // Relança a exceção original para que possa ser tratada em outro lugar.
            }
        }
    }
}
