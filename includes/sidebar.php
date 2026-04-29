<?php $tipo = $_SESSION['tipo']; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="/lam/dashboard.php">
            ✈️ ERP LAM
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuERP">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuERP">

            <ul class="navbar-nav me-auto">

                <!-- Dashboard (todos) -->
                <li class="nav-item">
                    <a class="nav-link" href="/lam/dashboard.php">Dashboard</a>
                </li>

                <!-- FROTA -->
                <?php if($tipo == 'admin' || $tipo == 'tecnico'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Frota
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/frota/listar.php">Listar</a></li>

                        <?php if($tipo == 'admin'){ ?>
                        <li><a class="dropdown-item" href="/lam/modules/frota/adicionar.php">Nova Aeronave</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

                <!-- VOOS -->
                <?php if($tipo == 'admin' || $tipo == 'operador'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Voos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/voos/listar.php">Listar</a></li>

                        <?php if($tipo == 'admin' || $tipo == 'operador'){ ?>
                        <li><a class="dropdown-item" href="/lam/modules/voos/adicionar.php">Criar Voo</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

                <!-- TRIPULAÇÃO -->
                <?php if($tipo == 'admin' || $tipo == 'operador'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Tripulação
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/tripulantes/listar.php">Listar</a></li>
                        <li><a class="dropdown-item" href="#">Escalas</a></li>
                    </ul>
                </li>
                <?php } ?>

                <!-- MRO -->
                <?php if($tipo == 'admin' || $tipo == 'tecnico'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Bilhetes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/bilhetes/adicionar.php">Vender</a></li>
                        <li><a class="dropdown-item" href="/lam/modules/bilhetes/listar.php">Listar</a></li>
                    </ul>
                </li>
                <?php } ?>

                <!-- FINANCEIRO (apenas admin) -->
                <?php if($tipo == 'admin'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Financeiro
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Custos</a></li>
                        <li><a class="dropdown-item" href="#">Receitas</a></li>
                    </ul>
                </li>
                <?php } ?>

            </ul>

            <!-- USER -->
            <span class="text-white me-3">
                👤 <?php echo $_SESSION['usuario']; ?> (<?php echo $tipo; ?>)
            </span>

            <a href="/lam/logout.php" class="btn btn-danger btn-sm">
                Sair
            </a>

        </div>
    </div>
</nav>