<?php
require 'controlador_agenda.php';
$contato = editarContatos($_GET['id']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>"EDITAR"</h3>

<!--form>input*4 -->
<form method="post" action="controlador_agenda.php?acao=editar">
    <input name="id" readonly type="text" value="<?= $contato['id'] ?>">
    <input name="nome" type="text" value="<?= $contato['nome'] ?>">
    <input name="email" type="email" value="<?= $contato['email'] ?>">
    <input name="telefone" type="text" value="<?= $contato['telefone'] ?>">

    <input type="submit" value="editar contato">
</form>

</body>
</html>