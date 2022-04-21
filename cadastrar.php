<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar Cliente');

use \App\Entity\Cliente;
$cliente = new Cliente;
//VALIDAÇÃO DO POST
if(isset($_POST['nome'], $_POST['endereco'], $_POST['ativo'])){

    $cliente->nome = $_POST['nome'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->ativo = $_POST['ativo'];

    $cliente->Cadastar();

    header('location: index.php?status=success');
    exit;
    
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
