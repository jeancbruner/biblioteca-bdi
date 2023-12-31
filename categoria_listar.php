<h1>Listar Categorias</h1>

<?php

$sql = "SELECT * FROM categoria ORDER BY nome ASC";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s). </p>";
    print "<table class = 'table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Nome</th>";
    print "<th>Descrição</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->id . "</td>";
        print "<td>" . $row->nome . "</td>";
        print "<td>" . $row->descricao . "</td>";
        print "<td>
            <button onclick=\"location.href='?page=categoria_editar&id_categoria=" . $row->id . "';\" 
            class ='btn btn-primary btn-block'>Editar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja excluir?'))
            {location.href='?page=categoria_salvar&acao=excluir&id_categoria=" . $row->id . "';}else{false;}\" 
            class ='btn btn-danger btn-block'>Excluir</button>
        </td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
?>