<?php
require_once '../model/db-connect.php';
session_start();
if (!isset($_SESSION['logado'])) header('Location: ../index.php');
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE idusuario = '$id'";
$result = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($result);
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restrict</title>
</head>
<body>
    <h1>Hello <?php echo $data['nome']; ?></h1>
    <a href="../controller/logout.php">Sair</a>
</body>
</html>