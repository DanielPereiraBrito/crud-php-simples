<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Cliente');

use \App\Entity\Cliente;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA O CLIENTE
$cliente = Cliente::GetCliente($_GET['id']);

//VALIDAÇÃO DO CLIENTE
if(!$cliente instanceof Cliente){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['nome'], $_POST['endereco'], $_POST['ativo'])){

    $cliente->nome = $_POST['nome'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->ativo = $_POST['ativo'];
    $cliente->Atualizar();
    print_r($cliente);exit;

    header('location: index.php?status=success');
    exit;
    
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
