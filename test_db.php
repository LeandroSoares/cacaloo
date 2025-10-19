<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=cacaloo', 'root', '');
    echo "Conexão com MySQL bem-sucedida!\n";
    echo "Versão do MySQL: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
?>
