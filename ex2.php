<?php

// Interface para geração de relatórios
interface Relatorio {
    public function gerar();
}

// Implementação básica de relatório
class RelatorioSimples implements Relatorio {
    protected $conteudo;

    public function __construct($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function gerar() {
        return "Relatório Simples: " . $this->conteudo;
    }
}

// Decorator base que servirá como base para os demais decoradores
abstract class Decorator implements Relatorio {
    protected $relatorio;

    public function __construct(Relatorio $relatorio) {
        $this->relatorio = $relatorio;
    }

    public function gerar() {
        return $this->relatorio->gerar();
    }
}

// Decorator para adicionar formatação em negrito ao relatório
class NegritoDecorator extends Decorator {
    public function gerar() {
        return "<strong>" . parent::gerar() . "</strong>";
    }
}

// Decorator para adicionar formatação em itálico ao relatório
class ItalicoDecorator extends Decorator {
    public function gerar() {
        return "<em>" . parent::gerar() . "</em>";
    }
}

// Exemplo de uso dos Decorators
$relatorio = new RelatorioSimples("Informações do relatório.");

// Adicionando formatação em negrito
$relatorioNegrito = new NegritoDecorator($relatorio);

// Adicionando formatação em itálico ao relatório com negrito
$relatorioNegritoItalico = new ItalicoDecorator($relatorioNegrito);

echo $relatorioNegritoItalico->gerar();

?>