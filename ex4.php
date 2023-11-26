<?php

// Interface para Observadores
interface Observador {
    public function atualizar(string $mensagem);
}

// Classe Sujeito (Notificação) - Mantém a lista de observadores e notifica sobre mudanças
class SujeitoNotificacao {
    private $observadores = [];

    public function adicionarObservador(Observador $observador) {
        $this->observadores[] = $observador;
    }

    public function removerObservador(Observador $observadorRemover) {
        foreach ($this->observadores as $indice => $observador) {
            if ($observador === $observadorRemover) {
                unset($this->observadores[$indice]);
                break;
            }
        }
    }

    public function notificarObservadores(string $mensagem) {
        foreach ($this->observadores as $observador) {
            $observador->atualizar($mensagem);
        }
    }
}

// Implementação de Observadores
class Usuario implements Observador {
    private $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function atualizar(string $mensagem) {
        echo "[$this->nome] Nova notificação: $mensagem\n";
    }
}

// Exemplo de uso do padrão Observer
$sujeito = new SujeitoNotificacao();

$usuario1 = new Usuario("Alice");
$usuario2 = new Usuario("Bob");

// Inscrevendo os usuários para receber notificações
$sujeito->adicionarObservador($usuario1);
$sujeito->adicionarObservador($usuario2);

// Enviando notificação aos observadores
$sujeito->notificarObservadores("Novo conteúdo disponível!");

// Removendo um observador
$sujeito->removerObservador($usuario1);

// Enviando outra notificação aos observadores restantes
$sujeito->notificarObservadores("Atualização importante!");
