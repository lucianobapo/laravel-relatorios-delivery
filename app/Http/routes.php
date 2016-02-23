<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/json',  ['as'=>'json.teste1', 'uses'=> function () {
        $metodosParaRelatoriosDeOrdem = new \App\Repositories\MetodosParaRelatoriosDeOrdem();

        $carbon = new \Carbon\Carbon;
        $comecoDoMes = $carbon->now()->subMonths(13)->firstOfMonth();
//        dd($comecoDoMes);
        $fimDoMes = $carbon->now()->subMonths(13)->firstOfMonth()->endOfMonth();
//        dd($fimDoMes);
        $diffInMonths = $carbon->diffInMonths($comecoDoMes);
//        dd($comecoDoMes-$fimDoMes);
//        dd($carbon->diffInMonths($comecoDoMes));

        $Orders = (new App\Models\Order)->with('orderItems','orderItems.cost')->get();

        $countMes = 0;
        $arr=[];
        do {
            $comecoDoMes = $carbon->now()->subMonths($countMes)->firstOfMonth();
            $fimDoMes = $carbon->now()->subMonths($countMes)->endOfMonth();
            $OrdersFiltred = $Orders
                ->filter(function($item) use ($comecoDoMes, $fimDoMes) {
                    if ($item->posted_at_carbon>=$comecoDoMes && $item->posted_at_carbon<=$fimDoMes){
                        return $item;
                    }
                });

            $arr[$comecoDoMes->timestamp]=$OrdersFiltred;
//            $arr[$comecoDoMes->timestamp]=$countMes;
            $countMes++;
        } while ( (count($OrdersFiltred)>0) || ($countMes<2));
        dd($arr);
        $comecoDoMes = $carbon->now()->subMonths(1)->firstOfMonth();
        $fimDoMes = $carbon->now()->subMonths(1)->endOfMonth();
        $Orders = $Orders
            ->filter(function($item) use ($comecoDoMes, $fimDoMes) {
                if ($item->posted_at_carbon>=$comecoDoMes && $item->posted_at_carbon<=$fimDoMes){
                    return $item;
                }
            });
        dd(count($Orders));
        if ($diffInMonths>0) {
//            dd($comecoDoMes->timestamp);
            $arr=[];
            while($diffInMonths>0){
                $diffInMonths--;
//                dd($diffInMonths);
                $comecoDoMes = $carbon->now()->subMonths($diffInMonths)->firstOfMonth();
                $fimDoMes = $carbon->now()->subMonths($diffInMonths)->firstOfMonth()->endOfMonth();
                //dd($carbon->diffInMonths($comecoDoMes));
                $arr[$comecoDoMes->timestamp] = $metodosParaRelatoriosDeOrdem->arrayDeSomaDosItens($Orders);
            }
            dd($arr);
        }

        return ($metodosParaRelatoriosDeOrdem->arrayDeSomaDosItens($Orders));
    }]);

    Route::get('/relatorios',  ['as'=>'relatorios.teste1', 'uses'=> function () {
        $metodosParaRelatoriosDeOrdem = new \App\Repositories\MetodosParaRelatoriosDeOrdem();

        $CostAllocates = (new App\Models\CostAllocate)
            ->orderBy('numero')
            ->get();
        $arrayDosCustos = $metodosParaRelatoriosDeOrdem->arrayDosCustos($CostAllocates);

        $carbon = new \Carbon\Carbon;
        $Orders = (new App\Models\Order)->with('orderItems','orderItems.cost')->get();
        $countMes = 0;
        $arr=[];
        do {
            $comecoDoMes = $carbon->now()->subMonths($countMes)->firstOfMonth();
            $fimDoMes = $carbon->now()->subMonths($countMes)->endOfMonth();
            $OrdersFiltred = $Orders
                ->filter(function($item) use ($comecoDoMes, $fimDoMes) {
                    if ($item->posted_at_carbon>=$comecoDoMes && $item->posted_at_carbon<=$fimDoMes){
                        return $item;
                    }
                });

            if (count($OrdersFiltred)>0) {
                $arr[$comecoDoMes->timestamp] = [
                    'titulo' => $comecoDoMes->format('F Y'),
                    'tabela' => $metodosParaRelatoriosDeOrdem
                        ->tabelaValoresDeOrdemDeVendaPorCusto(
                            $metodosParaRelatoriosDeOrdem->arrayDeSomaDosItens($OrdersFiltred),
                            $arrayDosCustos
                        ),
                ];
            }
            $countMes++;
        } while ( (count($OrdersFiltred)>0) || ($countMes<2));

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
        return view('components.appMain')->with([
            'mesesContent' => $arr,
        ]);

//        return $metodosParaRelatoriosDeOrdem->tabelaValoresDeOrdemDeVendaPorCusto(
//            $metodosParaRelatoriosDeOrdem->arrayDeSomaDosItens($Orders),
//            $metodosParaRelatoriosDeOrdem->arrayDosCustos($CostAllocates));
    }]);
});
