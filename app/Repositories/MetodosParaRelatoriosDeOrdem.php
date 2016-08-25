<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 05/01/16
 * Time: 14:20
 */

namespace App\Repositories;

use App\ModelLayer\Repositories\OrderRepositoryInterface;
use App\Models\Eloquent\CostAllocate;
use App\Models\Eloquent\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
//use Symfony\Component\DomCrawler\Form;

class MetodosParaRelatoriosDeOrdem
{
    /**
     * @var OrderRepositoryInterface
     */
    private $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
//        dd($this->repository);
    }

    protected function arrayDosCustos(Collection &$collection)
    {
        $result = [];
        foreach($collection as $cost){
            $result[$cost->nome]= $cost->numero . ' - ' . $cost->descricao;
        }
        return $result;
    }

    protected function arrayDeSomaDosItens(Collection $Orders)
    {
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

    protected function tabelaValoresDeOrdemDeVendaPorCusto(array $valores=[], array $titulos=[])
    {
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
        return ([
            'matriz'=>$matriz,
            'somaMatriz'=>$somaMatriz,
        ]);
    }

    public function arrayDosPeriodos()
    {
        $CostAllocates = (new CostAllocate)
            ->orderBy('numero')
            ->get();
//        dd($CostAllocates);
        $arrayDosCustos = $this->arrayDosCustos($CostAllocates);
//        dd($arrayDosCustos);
        $carbon = new Carbon;
        $Orders = $this->repository->collectionOrdersItemsCosts();
//        dd($Orders);
//        $Orders = (new Order)->with('orderItems','orderItems.cost')->get();
        $countMes = 0;
        $arr=[];
        do {
            $comecoDoMes = $carbon->now()->subMonths($countMes)->firstOfMonth();
            $fimDoMes = $carbon->now()->subMonths($countMes)->endOfMonth();
            $OrdersFiltred = $Orders
                ->filter(function($item) use ($comecoDoMes, $fimDoMes) {
//                    dd($item->posted_at_carbon);
                    if ($item->posted_at_carbon>=$comecoDoMes && $item->posted_at_carbon<=$fimDoMes){
//                        dd($item);
                        return $item;
                    }
                });
//            dd($fimDoMes);
//            dd($comecoDoMes);
//            dd($OrdersFiltred);

            if (count($OrdersFiltred)>0) {
                $arr[$comecoDoMes->timestamp] = array_merge(
                    ['titulo' => $comecoDoMes->format('F Y')],
                    $this->tabelaValoresDeOrdemDeVendaPorCusto(
                        $this->arrayDeSomaDosItens($OrdersFiltred),
                        $arrayDosCustos
                    ));
            }
            $countMes++;
        } while ( (count($OrdersFiltred)>0) || ($countMes<4));

        $antes = 0;
        foreach ($arr as $key => $value) {
            if ($antes == 0) $antes = $key;
            else {
                $arr[$antes]['depois']=$key;
                $arr[$key]['antes']=$antes;
                $antes = $key;
            }
        }

        reset($arr);
        return $arr;
    }
}