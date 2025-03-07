<?php

function geraCodigoAutenticacao(){
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  // Letras maiúsculas e números
    $codigo = '';
    for ($i = 0; $i < 6; $i++) {
        $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}