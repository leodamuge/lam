<!DOCTYPE html>
<html>
<head>
    <title>Login ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center vh-100">

<form action="auth.php" method="POST" class="bg-white p-4 rounded">
    <h3 class="mb-3">Login ERP</h3>

    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
    <input type="password" name="senha" class="form-control mb-2" placeholder="Senha">

    <button class="btn btn-primary w-100">Entrar</button>
</form>

</body>
</html>