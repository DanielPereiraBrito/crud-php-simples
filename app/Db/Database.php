<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'crud-teste';

    /**
     * Usuário do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instacia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * 
     * Define a tabela e instacia e conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->SetConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function SetConnection()
    {
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
        }
    }

    /**
     * Método responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function Execute($query, $params = [])
    {
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
        }
    }

    /**
     * Método responsavel por inserir dados no banco
     * @param array $values [field => value]
     * @return integer ID inserido
     */
    public function Insert($values)
    {
        //DADOS DA QUERY
        $keys = array_keys($values);
        $binds = array_pad([], count($keys), '?');

        //MONTA QUERY
        $query = "INSERT INTO {$this->table}(".implode(',', $keys).") VALUES (".implode(',', $binds).")";
        
        //EXECUTA O INSERT
        $this->Execute($query, array_values($values));
        
        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável executar uma consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function Select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? ' WHERE '.$where : '';
        $order = strlen($order) ? ' ORDER BY '.$order : '';
        $limit = strlen($limit) ? ' LIMIT '.$limit : '';

        //MONTA A QUERY
        $query = "SELECT {$fields} FROM {$this->table} {$where} {$order} {$limit}";

        //EXECUTA A QUERY
        return $this->Execute($query);
        
    }

    /**
     * Método responsavel por executar atualizações no banco de dados
     * @param string $where
     * @param array $values [field = value]
     * @return boolean
     */
    public function Update($where, $values)
    {
        //DADOS DA QUERY
        $keys = array_keys($values);


        //MONTA A QUERY
        $query = "UPDATE {$this->table} SET ".implode('=?,', $keys)."=? WHERE {$where}";
        
        //EXECUTAR A QUERY
        $this->Execute($query, array_values($values));

        return true;
    }

    /**
     * Método responsável por excluir dados do banco
     * @param string $where
     * @return boolean
     */
    public function Delete($where)
    {
        //MONTA A QUERY
        $query = "DELETE FROM {$this->table} WHERE {$where}";

        //EXECUTA A QUERY
        $this->Execute($query);

        return true;
    }
}
