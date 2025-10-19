<?php
// Teste do Xdebug - você pode colocar breakpoints aqui

echo "Início do teste de debug\n";

// Coloque um breakpoint na linha abaixo
$usuarios = [
    'João' => 'admin',
    'Maria' => 'user',
    'Pedro' => 'moderator'
];

foreach ($usuarios as $nome => $tipo) {
    echo "Usuário: {$nome}, Tipo: {$tipo}\n";

    // Breakpoint aqui para ver as variáveis
    if ($tipo === 'admin') {
        echo "Usuário administrativo encontrado!\n";
    }
}

echo "Fim do teste de debug\n";
