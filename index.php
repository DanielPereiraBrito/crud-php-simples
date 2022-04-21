<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Cliente;

$clientes = Cliente::GetClientes();


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/clientes.php';
include __DIR__.'/includes/footer.php';
