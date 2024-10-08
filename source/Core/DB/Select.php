<?php

namespace Autoload\Core\DB;

use Autoload\Core\Connect;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Métodos para busca no banco de dados
 */
class Select extends Connect
{
    private ?PDO $conn;
    private ?PDOStatement $stmt;

    /**
     * Obtém a instância da superclass
     */
    function __construct()
    {
        $this->conn = $this->getInstance();
    }

    /**
     * Busca registros na tabela $table
     * @param string $table Tabela em que ocorrerá a busca
     * @param string $where Filtro de busca. Ex: WHERE id=:id AND email=:email
     * @param string $params Parâmetros passados para busca. Ex: 'id=1&email=example@mail.com'
     * @param string $columns Colunas que serão retornadas
     * @return false|array Array de registros encontrados, ou false caso erro
     */
    public function selectAll(string $table, string $where = '', string $params = '', string $columns = '*'): false|array
    {
        $query = "SELECT {$columns} FROM {$table} {$where}";
        return $this->executeQuery($query, $params);
    }

    /**
     * Busca registros na tabela $table
     * @param string $table Tabela em que ocorrerá a busca
     * @param string $where Filtro de busca. Ex: WHERE id=:id
     * @param string $params Parâmetros passados para busca. Ex: 'id=1&email=example@mail.com'
     * @param string $columns Colunas que serão retornadas
     * @return false|mixed Primeiro registro encontrado
     */
    public function selectFirst(string $table, string $where = '', string $params = '', string $columns = '*'): mixed
    {
        $query = "SELECT {$columns} FROM {$table} {$where}";
        $params = $this->parseParams($params);

        try {
            $this->stmt = $this->conn->prepare($query);

            foreach ($params as $key => $value) {
                $this->stmt->bindValue(':' . $key, $value);
            }
            $this->stmt->execute();

            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro de leitura: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Executa uma query manual com suporte a JOINs e outros elementos SQL.
     * @param string $query A query SQL completa
     * @param string $params Parâmetros passados para busca. Ex: 'id=1&email=example@mail.com'
     * @return false|array Array de registros encontrados, ou FALSE caso erro
     */
    public function executeQuery(string $query, string $params = ''): false|array
    {
        $params = $this->parseParams($params);

        try {
            $this->stmt = $this->conn->prepare($query);

            foreach ($params as $key => $value) {
                $this->stmt->bindValue(':' . $key, $value);
            }
            $this->stmt->execute();

            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro de leitura: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Obtém a quantidade de registros encontrados
     * @return false|int
     */
    public function getRowCount(): false|int
    {
        if ($this->stmt) {
            return $this->stmt->rowCount();
        }
        return false;
    }

    #####################
    ## Private Methods ##
    #####################

    /**
     * Converte os parâmetros(string) em um array associativo
     * @param string $paramString
     * @return array
     */
    private function parseParams(string $paramString): array
    {
        $params = [];
        parse_str($paramString, $params);
        return $params;
    }
}