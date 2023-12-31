<h1>Editar Livro</h1>
<?php
$livroId = $_REQUEST['id_livro'];
    $sql1 = "SELECT livro.*, GROUP_CONCAT(livro_categoria.categoria_id) AS categorias
             FROM livro
             LEFT JOIN livro_categoria ON livro.id = livro_categoria.livro_id
             WHERE livro.id = $livroId
             GROUP BY livro.id";

    $res1 = $conn->query($sql1);
    $row1 = $res1->fetch_object();

    $categoriasSelecionadas = explode(',', $row1->categorias);
?>

<form action="?page=livro_salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_livro" value="<?php print $row1->id;?>">
    <div class="mb-3">
        <label>Categoria</label>
        <select name="categoria_id_categoria[]" class="form-control js-example-basic-multiple" multiple = "multiple">
            <option>Escolha</option>
            <?php
                $sql2 = "SELECT * FROM categoria ORDER BY nome ASC";
                $res2 = $conn->query($sql2);

                if($res2->num_rows >0){
                    while($row2 = $res2->fetch_object()) {
                        if ($row1->categoria_id == $row2->id) {
                            print "<option value = '".$row2->id."' selected>".$row2->nome."</option>";
                        } else {
                            print "<option value = '".$row2->id."'>".$row2->nome."</option>";
                        }
                    }
                } else {
                    print "<option>Não há marcas cadastradas</option>";
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Editora</label>
        <select class="form-control js-example-responsive" name="editora_id_editora">
            <option>Escolha</option>
            <?php
                $sql3 = "SELECT * FROM editora ORDER BY nome ASC";
                $res3 = $conn->query($sql3);

                if($res3->num_rows >0){
                    while($row3 = $res3->fetch_object()) {
                        if ($row1->editora_id == $row3->id) {
                            print "<option value = '".$row3->id."' selected>".$row3->nome."</option>";
                        } else {
                            print "<option value = '".$row3->id."'>".$row3->nome."</option>";
                        }
                    }
                } else {
                    print "<option>Não há marcas cadastradas</option>";
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Livro</label>
        <input type="text" value = "<?php print $row1->nome;?>" name = "nome_livro" class="form-control">
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" value = "<?php print $row1->autor;?>" name="nome_autor" class="form-control">
    </div>
    <div class="mb-3">
        <label>Ano de Publicação</label>
        <input type="text" value = "<?php print $row1->anoPublicacao;?>" name="ano_publicacao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Quantidade de exemplares</label>
        <input type="text" value = "<?php print $row1->qtdExemplares;?>" name="qtd_exemplares" class="form-control">
    </div>
        <button type="submit" class = "btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-example-responsive').select2();
    });
</script>