<?php
//FUNÇÃO PARA PEGAR CONTATOS
function pegarContatos(){
    $contatosAuxiliar = file_get_contents('contatos.json');
    $contatosAuxiliar = json_decode($contatosAuxiliar, true);
    return $contatosAuxiliar;
}
function salvarArquivoJson($contatosAuxiliar){
    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
    file_put_contents('contatos.json', $contatosJson);
    header("Location: ind_agenda.php");
}
//FUNÇÃO ṔARA CADASTRAR
function cadastrar($nome, $email, $telefone){
    $contatosAuxiliar = pegarContatos();
    $contato = [
        'id'      => uniqid(),
        'nome'    => $nome,
        'email'   => $email,
        'telefone' => $telefone
    ];
    array_push($contatosAuxiliar, $contato);
    salvarArquivoJson($contatosAuxiliar);
}

//FUNÇÃO PARA EXCLUIR CONTATOS DA LISTA
function excluirContatos($id){
    $contatosAuxiliar = pegarContatos();

    foreach ($contatosAuxiliar as $posicao => $contato){
        if($id == $contato['id']){
            unset($contatosAuxiliar[$posicao]);
        }
    }

    salvarArquivoJson($contatosAuxiliar);
}

//FUNÇÃO PARA EDITAR CONTATOS DA LISTA
function editarContatos($id){
    $contatosAuxiliar = pegarContatos();
    foreach ($contatosAuxiliar as $contato){
        if($contato['id'] == $id){
            return $contato;
        }
    }
}

//FUNCAO SALVAR CONTATO EDITADO
function salvarContatoEditado($id, $nome, $email, $telefone){
    $contatosAuxiliar = pegarContatos();
    foreach ($contatosAuxiliar as $posicao => $contato){
        if($contato['id'] == $id){
            $contatosAuxiliar[$posicao]['nome'] = $nome;
            $contatosAuxiliar[$posicao]['email'] = $email;
            $contatosAuxiliar[$posicao]['telefone'] = $telefone;
            break;
        }
    }
    salvarArquivoJson($contatosAuxiliar);
}
//FUNCAO BUSCAR
function buscar($nome){

    $nome = strtoupper($nome);
    $contatosAuxiliar = pegarContatos();

    $contatosEcontrados = [];

    foreach ($contatosAuxiliar as $posicao => $contato) {

        if (strtoupper($contato['nome']) == $nome) {
            $contatosEcontrados[] = $contato;
        }
    }

    return $contatosEcontrados;
}
//-----------------------------------------------------------------------------------------------------------------
if($_GET['acao'] == 'cadastrar'){
    cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
} elseif ($_GET['acao'] == 'excluir'){
    excluirContatos($_GET['id']);
} elseif ($_GET['acao'] == 'editar'){
    salvarContatoEditado($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
} elseif ($_GET['acao'] = 'buscar'){
    buscar($_GET['nome']);
}