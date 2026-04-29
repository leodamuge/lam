
<?php include("../../includes/header.php"); 
if($_SESSION['tipo'] != 'admin'){
    die("Acesso negado!");
}
?>
<?php include("../../includes/sidebar.php"); ?>

<div class="container mt-4 d-flex justify-content-center">

    <div class="card shadow p-4" style="width: 700px; border-radius:15px;">

        <h3 class="mb-4 text-center">✈️ Nova Aeronave</h3>

        <form action="salvar.php" method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Matrícula</label>
                    <input type="text" name="matricula" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Horas de Voo</label>
                    <input type="number" name="horas" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Ciclos</label>
                    <input type="number" name="ciclos" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="operacional">Operacional</option>
                        <option value="manutencao">Em Manutenção</option>
                        <option value="parado">Parado</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Foto da Aeronave</label>
                    <input type="file" name="foto" class="form-control" onchange="previewImagem(event)">
                </div>

                <div class="col-md-12 text-center mb-3">
                    <img id="preview" width="200" style="display:none; border-radius:10px;">
                </div>

            </div>

            <div class="d-flex justify-content-between">
                <a href="listar.php" class="btn btn-secondary">Voltar</a>
                <button class="btn btn-primary">Salvar Aeronave</button>
            </div>

        </form>

    </div>

</div>

<?php include("../../includes/footer.php"); ?>

<script>
function previewImagem(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>