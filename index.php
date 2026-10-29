<?php
session_star();
require_once 'Robo.php';
require_once 'Repositorio.php';

if (!isset($_SESSION['recargas'])){
    $SESSION['recargas'] = 0;
}

$robos = carregarRobos();
$mensagem = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cadastrar'])) {
$nome = trim($_POST['nome']);
$modelo = $_POST['modelo'];
$operador = trim($_POST['operador']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Central de Robôs</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Central de Robôs</h1>

<div class="box">
<p>Olá, <?= $_SESSION['operador'] ?? 'operador' ?>!</p>
<p>Recargas nesta sessão: <?= $_SESSION['recargas'] ?></p>
</div>

<?php if ($mensagem != ''): ?>
<p class="<?= $tipo ?>"><?= $mensagem ?></p>
<?php endif; ?>

<div class="box">
<h2>Cadastrar robô</h2>
<form method="POST">
<input type="text" name="nome" placeholder="Nome do robô">
<select name="modelo">
<option value="">Selecione o modelo</option>
<option value="Explorador">Explorador</option>
<option value="Engenheiro">Engenheiro</option>
<option value="Defensor">Defensor</option>
</select>
<input type="text" name="operador" placeholder="Nome do operador">
<button type="submit" name="cadastrar">Cadastrar</button>
</form>
</div>

<div class="box">
<h2>Frota</h2>

<?php foreach ($robos as $i => $robo): ?>
<div class="card <?= $robo->modelo ?>">
<h3><?= $robo->nome ?></h3>
<p><?= $robo->modelo ?></p>
<p><?= $robo->exibirStatus() ?></p>
<form method="POST">
<input type="hidden" name="indice" value="<?= $i ?>">
<button type="submit" name="recarregar">Recarregar</button>
</form>
</div>
<?php endforeach; ?>
</div>

</body>
</html>