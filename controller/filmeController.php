<?php
    require 'config.php';
    require 'model/filmeModel.php';

    importarFilmesDaAPI(''); // colocar aqui a chave da API

    $filmes = listarFilmes();

    require 'view/filmeView.php'
?>