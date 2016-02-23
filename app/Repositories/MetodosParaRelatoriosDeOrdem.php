<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 05/01/16
 * Time: 14:20
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
//use Symfony\Component\DomCrawler\Form;

class MetodosParaRelatoriosDeOrdem
{
    public function __construct()
    {
        \Html::component('lbpTable', 'components.table', ['name', 'value' => null, 'attributes' => [], 'matriz' => [], 'somaMatriz' => 0]);
        \Html::component('appMain', 'components.appMain', ['content']);
    }

    public function arrayDosCustos(Collection &$collection)
    {
        $result = [];
        foreach($collection as $cost){
            $result[$cost->nome]= $cost->numero . ' - ' . $cost->descricao;
        }
        return $result;
    }

    public function arrayValoresDeOrdemDeVendaPorCusto()
    {
        return [];
    }

    public function arrayDeSomaDosItens(Collection $Orders)
    {
//        $result = [];
//        foreach ($ItemOrders as $itemOrder) {
//            if (isset($itemOrder->order->type_id)){
//                $result[$itemOrder->cost->nome] = ($itemOrder->valor_unitario+$itemOrder->quantidade) + (isset($result[$itemOrder->cost->nome])?$result[$itemOrder->cost->nome]:0);
//            }
//        }
        $sum2 = [];
        foreach ($Orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                isset($sum2[$orderItem->cost->nome][$order->type_id])?
                    $sum2[$orderItem->cost->nome][$order->type_id] = ($orderItem->valor_unitario*$orderItem->quantidade)+
                        $sum2[$orderItem->cost->nome][$order->type_id]:
                    $sum2[$orderItem->cost->nome][$order->type_id] = ($orderItem->valor_unitario*$orderItem->quantidade);//
            }
        }
        return $sum2;
    }

    public function tabelaValoresDeOrdemDeVendaPorCusto(array $valores=[], array $titulos=[])
    {
//        \Debugbar::info($valores);
        if ($this->itensVazios()) {
            $somaMatriz = [];
            foreach ($titulos as $nome => $descricao) {
                $matriz[$nome]['nomes'] = $descricao;
            }
            foreach ($valores as $nomeDoCusto => $arrayDeOrdensEValores) {
                foreach ($arrayDeOrdensEValores as $keyTipoOrdem => $valor) {
                    $matriz[$nomeDoCusto][$keyTipoOrdem] = $valor;
                    $somaMatriz[$keyTipoOrdem] =  (isset($somaMatriz[$keyTipoOrdem]))?$somaMatriz[$keyTipoOrdem]+$valor:$valor;
                }

            }
//            \Debugbar::info($matriz);
//            \Debugbar::info($somaMatriz);
//            $somaMatriz = array_sum($valores);
//            dd($somaMatriz);
//            $matriz = [
//                'linha1' => [
//                    'coluna1' => 'linha1xcoluna1',
//                    'coluna2' => 'linha1xcoluna2',
//                ],
//                'linha2' => [
//                    'coluna1' => 'linha2xcoluna1',
//                    'coluna2' => 'linha2xcoluna2',
//                ],
//            ];
//            $content =
               return \Html::lbpTable('first_name', null, [], $matriz, $somaMatriz);
//            return \Html::appMain($content);
//            return 'Sem itens para exibir';
        }
    }

    private function itensVazios()
    {
        return true;
    }
}