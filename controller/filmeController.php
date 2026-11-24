<?php
    require 'config.php'; // chama o config (que contem as credenciais do DB)

    require 'model/filmeModel.php'; // possibilita acessar as funções que tem no model (filmeModel.php)

    importarFilmesDaAPI('621e8a8c54969b48f1df940ca413d7d3'); // colocar aqui a chave da API

    $filmes = listarFilmes(); // chama a função de listar Model (filmeModel.php)

    require 'view/filmeView.php' // chama a view (tela de visualização para o usuário)
?>