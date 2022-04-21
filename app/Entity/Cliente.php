<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Cliente
{
    /**
     * Identificador único do cliente
     * @var integer
     */
    public $id;

    /**
     * Nome do cliente
     * @var string
     */
    public $nome;

    /**
     * Endereco do cliente
     * @var string
     */
    public $endereco;

    /**
     * Define se o cliente está ativo
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data de criação do cliente
     * @var string
     */
    public $data;

    /**
     * Método responsável por atualizar cadastro do cliente
     * @return boolean
     */
    public function Atualizar()
    {
        return (new Database('clientes'))->Update("id = {$this->id}", ['nome' => $this->nome,
        'endereco' => $this->endereco,
        'ativo' => $this->ativo,
        'data' => $this->data]);
    }

    /**
     * Método responsavel por excluir a vaga do banco
     * @return boolean
     */
    public function Excluir()
    {
        return (new Database('clientes'))->Delete("id = {$this->id}");
    }

    /**
     * Método responsavel por cadastrar um novo cliente no banco
     * @return boolean
     */
    public function Cadastar()
    {
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO
        $obDatabase = new Database('clientes');
        $this->id = $obDatabase->Insert([
                        'nome' => $this->nome,
                        'endereco' => $this->endereco,
                        'ativo' => $this->ativo,
                        'data' => $this->data
                    ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por obter os clientes do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function GetClientes($where = null, $order = null, $limit = null)
    {
        return (new Database('clientes'))->Select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsavel por buscar um cliente com base no seu id
     * @param integer $id
     * @return Cliente
     */
    public static function GetCliente($id)
    {
        return (new Database('clientes'))->Select("id = {$id}")
                                         ->fetchObject(self::class);
    }

}