<?php

require_once 'Robo.php';

function carregarRobos(){    

        if (!file_exists('robos.json')) {
        file_put_contents('robos.json', '[]');
    }
    $dados = json_decode(file_get_contents('robos.json'), true);

    $robos = [];
    foreach ($dados as $d) {
        $robo = new Robo($d['nome'], $d['modelo']);
        $robo->energia = $d['energia'];  
        $robos[] = $robo;
    }
    return $robos;
}

function salvarRobos($robos)
{
    file_put_contents('robos.json', json_encode($robos, JSON_PRETTY_PRINT));
}