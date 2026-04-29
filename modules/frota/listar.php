<?php include("../../config/db.php"); ?>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/sidebar.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Frota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    #pesquisa {
    border-radius: 20px;
    padding: 10px;
}
</style>
</head>
<div class="container mt-4">

<h2>Aeronaves</h2>


<a href="adicionar.php" class="btn btn-success ">Nova Aeronave</a>
<a href="../../pdf/gerar_relatorio.php" class="btn btn-secondary mb-3">Gerar PDF</a>
<input 
    type="text" 
    id="pesquisa" 
    class="form-control mb-3" 
    placeholder="Pesquisar por modelo ou matrícula..."
    onkeyup="filtrarTabela()"
>

<table class="table table-bordered" id="tabelaAeronaves">
<tr>
    <th>ID</th>
    <th>Modelo</th>
    <th>Matrícula</th>
    <th>Horas</th>
    <th>Status</th>
    <th>Foto</th>
    <th>Ações</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM aeronaves");

while($row = $result->fetch_assoc()){

    // definir cor do status
    $status = $row['status'];
    $cor = 'secondary';

    if($status == 'operacional') $cor = 'success';
    if($status == 'manutencao') $cor = 'warning';
    if($status == 'parado') $cor = 'danger';

    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['modelo']}</td>
        <td>{$row['matricula']}</td>
        <td>{$row['horas_voo']}</td>

        <td>
            <span class='badge bg-$cor text-uppercase'>$status</span>
        </td>

        <td>";
        
        // FOTO
        if(!empty($row['foto'])){
            echo "<img src='../../uploads/{$row['foto']}' width='100' style='border-radius:8px;'>";
        } else {
            echo "Sem foto";
        }

    echo "</td>

        <td>";
        
        // AÇÕES (apenas admin)
        if($_SESSION['tipo'] == 'admin'){
            echo "
                <a href='editar.php?id={$row['id']}' class='btn btn-sm btn-warning me-1'>✏️</a>
                <a href='eliminar.php?id={$row['id']}' 
                   class='btn btn-sm btn-danger'
                   onclick=\"return confirm('Tem certeza que deseja eliminar esta aeronave?')\">🗑️</a>
            ";
        } else {
            echo "<span class='text-muted'>Sem acesso</span>";
        }

    echo "</td>

    </tr>";
}
?>

</table>

</div>
<?php include("../../includes/footer.php"); ?>

<script>
    function filtrarTabela() {
    let input = document.getElementById("pesquisa").value.toLowerCase();
    let linhas = document.querySelectorAll("#tabelaAeronaves tr");

    linhas.forEach((linha, index) => {
        if(index === 0) return; // ignora cabeçalho

        let texto = linha.innerText.toLowerCase();

        if(texto.includes(input)){
            linha.style.display = "";
        } else {
            linha.style.display = "none";
        }
    });
}
</script>