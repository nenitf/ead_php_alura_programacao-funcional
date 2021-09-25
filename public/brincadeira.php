<?php

function qualquer(): string
{
    return 'Olá mundo!';
}

function outra(callable $funcao): void
{
    echo 'Executando outra função: ';
    echo $funcao();
}

# outra(quakquer()); // não funciona

# outra('qualquer'); // funciona

# outra(function() {
# return 'Função anônima';
# }); // funciona

$funcaoAnonima = function() {
    return 'Função anônima na var';
}; // expressão precisa de ; depois do }
outra($funcaoAnonima);
