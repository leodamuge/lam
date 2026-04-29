<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="/lam_erp/dashboard.php">
            ✈️ ERP LAM
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuERP">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuERP">

            <ul class="navbar-nav me-auto">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link" href="/lam/dashboard.php">Dashboard</a>
                </li>

                <!-- FROTA -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Frota
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/frota/listar.php">Listar Aeronaves</a></li>
                        <li><a class="dropdown-item" href="/lam/modules/frota/adicionar.php">Nova Aeronave</a></li>
                        <li><a class="dropdown-item" href="/lam/pdf/gerar_relatorio.php">Relatório PDF</a></li>
                    </ul>
                </li>

                <!-- VOOS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Voos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lam/modules/voos/listar.php">Listar Voos</a></li>
                        <li><a class="dropdown-item" href="/lam/modules/voos/adicionar.php">Criar Voo</a></li>
                    </ul>
                </li>

                <!-- TRIPULAÇÃO -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Tripulação
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Listar Tripulantes</a></li>
                        <li><a class="dropdown-item" href="#">Adicionar Tripulante</a></li>
                        <li><a class="dropdown-item" href="#">Escalas</a></li>
                    </ul>
                </li>

                <!-- MRO -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        MRO
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Ordens de Serviço</a></li>
                        <li><a class="dropdown-item" href="#">Manutenção Preventiva</a></li>
                    </ul>
                </li>

                <!-- FINANCEIRO -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Financeiro
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Custos de Voo</a></li>
                        <li><a class="dropdown-item" href="#">Receitas</a></li>
                    </ul>
                </li>

            </ul>

            <!-- USUÁRIO -->
            <span class="text-white me-3">
                👤 <?php echo $_SESSION['usuario']; ?>
            </span>

            <a href="/lam_erp/logout.php" class="btn btn-danger btn-sm">
                Sair
            </a>

        </div>
    </div>
</nav>