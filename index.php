<?php
session_start();
//if(!isset($_SESSION['usuario_online']) OR !($_SESSION['usuario_online'] == true) ){
//header('Location: login.php');
//}
//OR ESSE:
$logado = isset($_SESSION['usuario_online']);
if ($logado == false){
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<div class="social">

    <a href="verifica_usuario.php?acao=sair" class="sair">sair</a>

    <img src="https://yt3.ggpht.com/-aZ8t43Ux4mA/AAAAAAAAAAI/AAAAAAAAAAA/-NhoOwp831c/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="" width="200" height="200">
    <h3>Bem vindo!</h3>
    <a href="ind_agenda.php">ABRIR AGENDA</a>
    <?php header('Location: ind_agenda.php'); ?>
</div>

</body>
</html>