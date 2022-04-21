<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>
    <form method="post">

        <div class="form-group mt-3">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="<?=(isset($cliente->nome) ? $cliente->nome : '')?>">
        </div>

        <div class="form-group mt-3">
            <label>Endereco</label>
            <input type="text" class="form-control" name="endereco" value="<?=(isset($cliente->endereco) ? $cliente->endereco : '')?>">
        </div>

        <div class="form-group mt-3">
            <label>Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?=(isset($cliente->ativo) ? $cliente->ativo == 'n' : '') == 'n' ? 'checked' : '' ?>> Inativo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>