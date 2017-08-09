<?php
session_start();

//caso esteja logado, redireciona para login.php
$logado = isset($_SESSION['usuario_online']);
if ($logado == false){
    header('Location: login.php');
}

require 'controlador_agenda.php';

if (isset($_GET['buscar']) and !empty($_GET['buscar'])) {
    $meusContatos = buscar($_GET['buscar']);
} else {
    $meusContatos = pegarContatos();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <h1><center><a href="verifica_usuario.php?acao=sair" class="sair">sair</a></center></h1>


<div class="container" style="margin-top: 30px;">

    <h3>MINHA AGENDA DE CONTATOS</h3>
    <br />

    <!--<a href="verifica_usuario.php?acao=logout">SAIR</a>-->

    <!--campo pesquisar-->

    <form class="form-horizontal" method="get" action="">
        <fieldset>

            <!-- Appended Input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">PESQUISAR</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input name="buscar" class="form-control" placeholder="Digite um nome..." type="text">
                        <input type="submit" value="buscar">
    
                    </div>

                </div>
            </div>
        </fieldset>
    </form>



<!--    <form method="get" action="" class="form-horizontal">
        <input name="pesquisa" class="form-control" placeholder="Nome do Contato" type="text">
        <button type="submit" class="btn btn-default">BUSCAR</button>
    </form> -->

    <br>
    <br>
    <!-- CADASTRO-->
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" method="post" action="controlador_agenda.php?acao=cadastrar">

                <!--nome-->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome">
                </div>

                <!--email-->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>

                <!--telefone-->
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="telefone">
                </div>

                <button type="submit" class="btn btn-default">CADASTRAR</button>

            </form>
        </div>
    </div>

    <br />

    <!--CONTATOS-->
    <div class="row">
        <div class="col-md-12">

            <!-- Conteúdo -->
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <!-- repetir -->
                <?php foreach ($meusContatos as $contato): ?>
                    <tr>
                        <td> <?php echo $contato['id'] ?>  </td>
                        <td> <?php echo $contato['nome'] ?> </td>
                        <td> <?php echo $contato['email'] ?> </td>
                        <td> <?php echo $contato['telefone'] ?> </td>
                        <td>
                            <a href="controlador_agenda.php?acao=excluir&id=<?php echo $contato['id'] ?>">EXCLUIR</a>
                            <a href="editar.php?id=<?php echo $contato['id'] ?>">EDITAR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>