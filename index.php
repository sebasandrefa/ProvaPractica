<?php
session_start();
require_once 'Robo.php';
require_once 'Repositorio.php';

if (!isset($_SESSION['recargas'])) {
$_SESSION['recargas'] = 0;
}

$robos = carregarRobos();
$mensagem = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


if (isset($_POST['cadastrar'])) {
$nome = trim($_POST['nome']);
$modelo = $_POST['modelo'];
$operador = trim($_POST['operador']);



if ($nome == '' || $modelo == '' || $operador == '') {
$mensagem = 'Preencha todos os campos!';
$tipo = 'erro';
} else {
$robos[] = new Robo($nome, $modelo);
salvarRobos($robos);
$_SESSION['operador'] = $operador;
$mensagem = "Robô $nome cadastrado com sucesso!";
$tipo = 'sucesso';
    }
}

if (isset($_POST['recarregar'])) {
$robo = $robos[$_POST['indice']];

if ($robo->recarregar()) {
salvarRobos($robos);
$_SESSION['recargas']++;
$mensagem = "$robo->nome recarregado! Energia: $robo->energia";
$tipo = 'sucesso';
} else {
$mensagem = "$robo->nome já está com energia máxima!";
$tipo = 'erro';
        }
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