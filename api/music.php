<?php

require_once '../model/music.php';
require_once '../functions/music.php';

$url = $_SERVER[ 'REQUEST_URI' ];
$method = $_SERVER[ 'REQUEST_METHOD' ];

$erMusics = '/^\/api\/musics\/?$/i';
$erOneMusic = '/^\/api\/musics\/([0-9]{1,50})\/?$/i';

$matches = [];

header('Content-Type: application/json');

if (preg_match($erMusics, $url) && $method == 'GET'){
    try {
        $musics = viewMusics();
        $json = json_encode($musics);
        die($json);
    } catch(Exception $e){
        http_response_code(500);
        die(json_encode(['Erro ao consultar musicas']));
    }
} elseif (preg_match($erOneMusic, $url, $matches) && $method == 'GET'){
    $id = $matches[1];

    try {
        $music = viewMusic($id);
        $json = json_encode($music);
        die($json);
    } catch (Exception $e){
        http_response_code(500);
        die(json_encode(['Erro ao consultar musica']));
    }
} elseif (preg_match($erMusics, $url) && $method == 'POST'){
    $content = file_get_contents('php://input');
    $data = json_decode($content, true);

    try{
        $music = new Music($data['musicName'] ?? '', $data['singer'] ?? '');
        insertMusic($music);
        http_response_code(201);
        die(json_encode(['Cadastro realizado com sucesso']));
    } catch(Exception $e){
        http_response_code(500);
        die(json_encode(['Erro ao cadastrar musica']));
    }
} elseif(preg_match($erOneMusic, $url, $matches) && $method == 'PUT'){
    $id = $matches[1];
    $content = file_get_contents('php://input');
    $data = json_decode($content, true);

    try{
        $music = new Music($data['musicName'] ?? '', $data['singer'] ?? '', $id ?? null);
        updateMusic($music);
        http_response_code(204);
        die(json_encode(['Sucesso ao atualizar musica']));
    } catch(Exception $e){
        http_response_code(500);
        die(json_encode('Erro ao atualizar musica'));
    }
} elseif(preg_match($erOneMusic, $url, $matches) && $method == 'DELETE'){
    $id = $matches[1];

    try{
        deleteMusic($id);
        http_response_code(204);
        die(json_encode(['Musica deletada com sucesso']));
    } catch(Exception $e){
        http_response_code(500);
        die(json_encode(['Erro ao deletar musica']));
    }
}