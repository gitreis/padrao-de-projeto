<?php

// Interface para estratégias de ordenação
interface EstrategiaOrdenacao {
    public function ordenar(array $elementos): array;
}

// Implementação do algoritmo Bubble Sort
class OrdenacaoBubbleSort implements EstrategiaOrdenacao {
    public function ordenar(array $elementos): array {
        $tamanho = count($elementos);
        for ($i = 0; $i < $tamanho - 1; $i++) {
            for ($j = 0; $j < $tamanho - $i - 1; $j++) {
                if ($elementos[$j] > $elementos[$j + 1]) {
                    $temp = $elementos[$j];
                    $elementos[$j] = $elementos[$j + 1];
                    $elementos[$j + 1] = $temp;
                }
            }
        }
        return $elementos;
    }
}

// Implementação do algoritmo Quick Sort
class OrdenacaoQuickSort implements EstrategiaOrdenacao {
    public function ordenar(array $elementos): array {
        if (count($elementos) <= 1) {
            return $elementos;
        }
        
        $pivot = $elementos[0];
        $menor = $maior = [];
        
        for ($i = 1; $i < count($elementos); $i++) {
            if ($elementos[$i] < $pivot) {
                $menor[] = $elementos[$i];
            } else {
                $maior[] = $elementos[$i];
            }
        }
        
        $ordenacaoQuickSort = new self();
        return array_merge(
            $ordenacaoQuickSort->ordenar($menor),
            [$pivot],
            $ordenacaoQuickSort->ordenar($maior)
        );
    }
}

// Utilização do padrão Strategy para ordenação
class AlgoritmoOrdenacao {
    private $estrategia;

    public function __construct(EstrategiaOrdenacao $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function alterarEstrategia(EstrategiaOrdenacao $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function executarOrdenacao(array $elementos): array {
        return $this->estrategia->ordenar($elementos);
    }
}

// Exemplo de uso e troca de estratégia de ordenação
$lista = [5, 2, 9, 1, 5, 6];

$algoritmoOrdenacao = new AlgoritmoOrdenacao(new OrdenacaoBubbleSort());
$resultado = $algoritmoOrdenacao->executarOrdenacao($lista);
echo "Resultado do Bubble Sort: " . implode(", ", $resultado) . "\n";

$algoritmoOrdenacao->alterarEstrategia(new OrdenacaoQuickSort());
$resultado = $algoritmoOrdenacao->executarOrdenacao($lista);
echo "Resultado do Quick Sort: " . implode(", ", $resultado) . "\n";

?>