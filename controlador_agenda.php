<?php
//FUNÇÃO PARA PEGAR CONTATOS
function pegarContatos()
{
    $contatosAuxiliar = file_get_contents('contatos.json'); //Leitura do Arquivo
    $contatosAuxiliar = json_decode($contatosAuxiliar, true); //converte dados do Json para array
    return $contatosAuxiliar; //retorna a variável contatos Auxiliar
}

function salvarArquivoJson($contatosAuxiliar)
{
    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);//converte dados do array para json
    file_put_contents('contatos.json', $contatosJson); //atualiza o conteúdo do Json
    header("Location: ind_agenda.php"); //redireciona para outra pagina
}

//FUNÇÃO ṔARA CADASTRAR
function cadastrar($nome, $email, $telefone)
{
    $contatosAuxiliar = pegarContatos();
    $contato = [
        'id' => uniqid(), //deixar uma indentificação única
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone
    ];
    array_push($contatosAuxiliar, $contato);//adiciona valores ao array
    salvarArquivoJson($contatosAuxiliar);
}

//FUNÇÃO PARA EXCLUIR CONTATOS DA LISTA
function excluirContatos($id)
{
    $contatosAuxiliar = pegarContatos();

    foreach ($contatosAuxiliar as $posicao => $contato) { /*itera sobre o array. percorre cada contato da %contatosAuxiliar para pegar id do contato*/
        if ($id == $contato['id']) {
            unset($contatosAuxiliar[$posicao]); //Destrói a posição do contato com o id requisitado da variavel $contatoAuxiliar
        }
    }

    salvarArquivoJson($contatosAuxiliar);
}

//FUNÇÃO PARA EDITAR CONTATOS DA LISTA
function editarContatos($id)
{
    $contatosAuxiliar = pegarContatos();
    foreach ($contatosAuxiliar as $contato){ /*itera sobre o array. percorre cada contato do $contatosAuxiliar para pegar id do contato*/
        if ($contato['id'] == $id) {
            return $contato;
        }
    }
}

//FUNCAO SALVAR CONTATO EDITADO
function salvarContatoEditado($id, $nome, $email, $telefone)
{
    $contatosAuxiliar = pegarContatos();
    foreach ($contatosAuxiliar as $posicao => $contato) {/*itera sobre o array. percorre cada contato do contatosAuxiliar para pegar informações do contato*/
        if ($contato['id'] == $id) {
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

    foreach ($contatosAuxiliar as $posicao => $contato) { /*itera sobre o array. percorre cada contato do contatosAuxiliar para pegar nome contato*/

        if (strtoupper($contato['nome']) == $nome) {
            $contatosEcontrados[] = $contato;
        }
    }

    return $contatosEcontrados;
}

//-----------------------------------------------------------------------------------------------------------------
if ($_GET['acao'] == 'cadastrar') {
    cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
} elseif ($_GET['acao'] == 'excluir') {
    excluirContatos($_GET['id']);
} elseif ($_GET['acao'] == 'editar') {
    salvarContatoEditado($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
} elseif ($_GET['acao'] = 'buscar') {
    buscar($_GET['nome']);
}