<h1 class="mb-3">Realizar Locação</h1>

<form action="?page=locacao_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Leitor</label>
        <select class="form-control js-example-responsive" name="leitor_id_leitor">
            <?php
            $sql = "SELECT * FROM leitor ORDER BY nome ASC";
            $res = $conn->query($sql);

            if ($res->num_rows > 0) {
                while ($row = $res->fetch_object()) {
                    print "<option value='" . $row->id . "'>" . $row->nome . "</option>";
                }
            } else {
                print "<option>Não há leitores cadastradas</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Livro</label>
        <select class="form-control js-example-responsive" name="livro_id_livro">
            <?php
            $sql2 = "SELECT * FROM livro ORDER BY nome ASC";
            $res2 = $conn->query($sql2);

            if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_object()) {
                    print "<option value='" . $row2->id . "'>" . $row2->nome . "</option>";
                }
            } else {
                print "<option>Não há livros cadastrados</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="data_locacao">Data de Locação</label>
        <input type="date" name="data_locacao" class="form-control" id="data_locacao">
    </div>

    <div class="form-group">
        <label for="data_devolucaoE">Data de Devolução</label>
        <input type="date" name = "data_devolucaoE" class="form-control" id="data_devolucaoE" disabled>
    </div>
    <div class="mb-3">
        <label>Observações</label>
        <textarea type="text" name = "observacao" class="form-control" rows ="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
</form>

<script>
    $(document).ready(function() {
        $('.js-example-responsive').select2();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Obter referências aos elementos de data
        var data_locacao = document.getElementById('data_locacao');
        var data_devolucaoE = document.getElementById('data_devolucaoE');

        data_locacao.addEventListener('input', function() {
            // Habilitar o campo de data_devolucaoE
            data_devolucaoE.disabled = false;

            // Obter a data selecionada no campo de data_locacao
            var dataSelecionada1 = new Date(data_locacao.value);

            // Calcular a data mínima para o campo de data_devolucaoE
            var dataMinima2 = new Date(dataSelecionada1);
            dataMinima2.setDate(dataMinima2.getDate() + 1); // Adicionar 1 dia

            // Configurar a data mínima para o campo de data_devolucaoE
            data_devolucaoE.min = dataMinima2.toISOString().split('T')[0];
        });
    });
</script>