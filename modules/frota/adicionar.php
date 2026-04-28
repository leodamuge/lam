<form action="salvar.php" method="POST" enctype="multipart/form-data" class="container mt-4">
    <h2>Nova Aeronave</h2>

    <input type="text" name="modelo" class="form-control mb-2" placeholder="Modelo">
    <input type="text" name="matricula" class="form-control mb-2" placeholder="Matrícula">
    <input type="number" name="horas" class="form-control mb-2" placeholder="Horas de voo">
    <input type="number" name="ciclos" class="form-control mb-2" placeholder="Ciclos">
    <select name="status" class="form-control mb-2">
    <option value="operacional">Operacional</option>
    <option value="parado">Parado</option>
    <option value="manutencao">Em Manutenção</option>
</select>

    <!-- NOVO CAMPO -->
    <input type="file" name="foto" class="form-control mb-2" onchange="previewImagem(event)">

    <img id="preview" width="200" style="display:none; border-radius:10px;">

    <button class="btn btn-primary">Salvar</button>
</form>
<script>
function previewImagem(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>