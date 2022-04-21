<?php

    $mensagem = "";
    if(isset($_GET['status'])){
        switch ($_GET['status']){
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }

    $resultados = '';
    foreach($clientes as $cliente){
        $resultados .=  '<tr>
                            <td>'.$cliente->id.'</td>
                            <td>'.$cliente->nome.'</td>
                            <td>'.$cliente->endereco.'</td>
                            <td>'.($cliente->ativo == 's' ? 'Ativo' : 'Inativo') .'</td>
                            <td>'.date('d/m/Y à\s H:i:s', strtotime($cliente->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$cliente->id.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$cliente->id.'">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhuma vaga encontrada
                                                        </td>
                                                       </tr>';
                                                        
?>
<main>
    <?=$mensagem?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success"> Novo Cliente</button>
        </a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>ENDEREÇO</th>
                    <th>STATUS</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>  
                </tr>
            </thead>
            <tbody>
                <?= $resultados;?>
            </tbody>
        </table>
    </section>
</main>