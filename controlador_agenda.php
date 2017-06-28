<?php
    //FUNÇÃO ṔARA CADASTRAR
    function cadastrar(){

        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        $contato = [
             'id'      => uniqid(),
             'nome'    => $_POST['nome'],
             'email'   => $_POST['email'],
            'telefone'=> $_POST['telefone']
        ];

        array_push($contatosAuxiliar, $contato);

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

        file_put_contents('contatos.json', $contatosJson);

        header("Location: index.php");
    }

    //FUNÇÃO PARA PEGAR CONTATOS
    function pegarContatos(){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        return $contatosAuxiliar;
    }

    //FUNÇÃO PARA EXCLUIR CONTATOS DA LISTA
    function excluirContatos($id){
            //pegarContatos();
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        foreach ($contatosAuxiliar as $posicao => $contato){
            if($id == $contato['id']){
                unset($contatosAuxiliar[$posicao]);
            }
        }

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        file_put_contents('contatos.json', $contatosJson);

        header('Location: index.php');

    }


    //FUNÇÃO PARA EDITAR CONTATOS DA LISTA
    function ediiarContatos(){

    }

    if($_GET['acao'] == 'cadastrar'){
        cadastrar();
    } elseif ($_GET['acao'] == 'excluir'){
        excluirContatos($_GET['id']);
    }