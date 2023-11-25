<?php

class RegistroUsuarios {
    private static $instance = null;
    private $usuarios = [];

    private function __construct() {
        // Construtor privado para evitar instanciar a classe diretamente
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new RegistroUsuarios();
        }
        return self::$instance;
    }

    public function adicionarUsuario($usuario) {
        $this->usuarios[] = $usuario;
    }

    public function listarUsuarios() {
        return $this->usuarios;
    }
}

// Exemplo de uso do Singleton para registrar usuários
$registro = RegistroUsuarios::getInstance();

$registro->adicionarUsuario("Lucas");
$registro->adicionarUsuario("Valeria");
$registro->adicionarUsuario("Rafael");

// Listagem dos usuários registrados
$usuariosRegistrados = $registro->listarUsuarios();
echo "Usuários registrados: " . implode(", ", $usuariosRegistrados);

?>