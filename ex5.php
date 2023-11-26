<?php

// Interface para formas geométricas
interface Forma {
    public function calcularArea(): float;
}

// Implementação da forma de Círculo
class Circulo implements Forma {
    private $raio;

    public function __construct($raio) {
        $this->raio = $raio;
    }

    public function calcularArea(): float {
        return pi() * $this->raio * $this->raio;
    }
}

// Implementação da forma de Quadrado
class Quadrado implements Forma {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea(): float {
        return $this->lado * $this->lado;
    }
}

// Fábrica de formas
class FabricaFormas {
    public function criarForma($tipo, ...$args): Forma {
        switch ($tipo) {
            case 'Circulo':
                return new Circulo(...$args);
            case 'Quadrado':
                return new Quadrado(...$args);
            default:
                throw new InvalidArgumentException("Tipo de forma desconhecido");
        }
    }
}

// Exemplo de uso da fábrica de formas
$fabrica = new FabricaFormas();

// Criação de um círculo
$circulo = $fabrica->criarForma('Circulo', 5); // raio = 5
echo "Área do círculo: " . $circulo->calcularArea() . "\n";

// Criação de um quadrado
$quadrado = $fabrica->criarForma('Quadrado', 4); // lado = 4
echo "Área do quadrado: " . $quadrado->calcularArea() . "\n";
