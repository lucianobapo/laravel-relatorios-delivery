<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
        <title>Laravel</title>
{{--        <link href="{{ elixir('css/app.compiled.css') }}" rel="stylesheet">--}}
        <link href="{{ elixir('css/ionic.css') }}" rel="stylesheet">
        <!-- ionic/angularjs js -->
        <script src="{{ elixir('js/app.compiled.js') }}"></script>

        <script type="text/javascript">
            modApp.config(function($stateProvider, $urlRouterProvider) {
                $stateProvider
                        .state('tabs.facts3', {
                            url: "/facts3",
                            views: {
                                'home-tab': {
                                    templateUrl: "templates/facts3.html"
                                }
                            }
                        });
            });
        </script>
    </head>
    <body ng-app="starter">

    <ion-nav-bar class="bar-positive">
        <ion-nav-back-button>
        </ion-nav-back-button>
    </ion-nav-bar>

    <ion-nav-view></ion-nav-view>


    <script id="templates/tabs.html" type="text/ng-template">
        <ion-tabs class="tabs-icon-top tabs-positive">

            <ion-tab title="Home" icon="ion-home" href="#/tab/home">
                <ion-nav-view name="home-tab"></ion-nav-view>
            </ion-tab>

            <ion-tab title="About" icon="ion-ios-information" href="#/tab/about">
                <ion-nav-view name="about-tab"></ion-nav-view>
            </ion-tab>

            <ion-tab title="Contact" icon="ion-ios-world" ui-sref="tabs.contact">
                <ion-nav-view name="contact-tab"></ion-nav-view>
            </ion-tab>

        </ion-tabs>
    </script>

    <script id="templates/home.html" type="text/ng-template">
        <ion-view view-title="Home">
            <ion-content class="padding">
                <p>
                    <a class="button icon icon-right ion-chevron-right" href="#/tab/{{ $primeiro=key($mesesContent) }}">{{ $mesesContent[$primeiro]['titulo'] }}</a>
                </p>
            </ion-content>
        </ion-view>
    </script>

    @foreach($mesesContent as $timestamp=>$conteudo)
        <script type="text/javascript">
            modApp.config(function($stateProvider) {
                $stateProvider
                        .state('tabs.{{ $timestamp }}', {
                            url: "/{{ $timestamp }}",
                            views: {
                                'home-tab': {
                                    templateUrl: "templates/{{ $timestamp }}.html"
                                }
                            }
                        });
            });
        </script>
        <script id="templates/{{ $timestamp }}.html" type="text/ng-template">
            <ion-view view-title="{{ $conteudo['titulo'] }}">
                <ion-content class="padding">
                    @include('components.table', ['matriz'=>$conteudo['matriz'],'somaMatriz'=>$conteudo['somaMatriz']])
                    <p>
                        <a class="button icon ion-home" href="#/tab/home"> Home</a>
                        @if(isset($conteudo['depois']))
                            <a class="button icon icon-right ion-chevron-right" href="#/tab/{{ $conteudo['depois'] }}">Próximo</a>
                        @endif
                    </p>
                </ion-content>
            </ion-view>
        </script>
    @endforeach

    <script id="templates/facts.html" type="text/ng-template">
        <ion-view view-title="Facts">
            <ion-content class="padding">
                { $content }}
                <p>
                    <a class="button icon ion-home" href="#/tab/home"> Home</a>
                    <a class="button icon icon-right ion-chevron-right" href="#/tab/facts2">More Facts</a>
                </p>
            </ion-content>
        </ion-view>
    </script>

    <script id="templates/facts2.html" type="text/ng-template">
        <ion-view view-title="Also Factual">
            <ion-content class="padding">
                <p>111,111,111 x 111,111,111 = 12,345,678,987,654,321</p>
                <p>1 in every 4 Americans has appeared on T.V.</p>
                <p>11% of the world is left-handed.</p>
                <p>1 in 8 Americans has worked at a McDonalds restaurant.</p>
                <p>$283,200 is the absolute highest amount of money you can win on Jeopardy.</p>
                <p>101 Dalmatians, Peter Pan, Lady and the Tramp, and Mulan are the only Disney cartoons where both parents are present and don't die throughout the movie.</p>
                <p>
                    <a class="button icon ion-home" href="#/tab/home"> Home</a>
                    <a class="button icon ion-chevron-left" href="#/tab/facts3"> Scientific Facts</a>
                </p>
            </ion-content>
        </ion-view>
    </script>

    <script id="templates/facts3.html" type="text/ng-template">
        <ion-view view-title="Also Factual">
            <ion-content class="padding">
                <p>111,111,111 x 111,111,111 = 12,345,678,987,654,321</p>

                <p>
                    <a class="button icon ion-home" href="#/tab/home"> Home</a>
                    <a class="button icon ion-chevron-left" href="#/tab/facts2"> Scientific Facts</a>
                </p>
            </ion-content>
        </ion-view>
    </script>

    <script id="templates/about.html" type="text/ng-template">
        <ion-view view-title="About">
            <ion-content class="padding">
                <h3>Create hybrid mobile apps with the web technologies you love.</h3>
                <p>Free and open source, Ionic offers a library of mobile-optimized HTML, CSS and JS components for building highly interactive apps.</p>
                <p>Built with Sass and optimized for AngularJS.</p>
                <p>
                    <a class="button icon icon-right ion-chevron-right" href="#/tab/navstack">Tabs Nav Stack</a>
                </p>
            </ion-content>
        </ion-view>
    </script>

    <script id="templates/nav-stack.html" type="text/ng-template">
        <ion-view view-title="Tab Nav Stack">
            <ion-content class="padding">
                <p><img src="http://ionicframework.com/img/diagrams/tabs-nav-stack.png" style="width:100%"></p>
            </ion-content>
        </ion-view>
    </script>

    <script id="templates/contact.html" type="text/ng-template">
        <ion-view title="Contact">
            <ion-content>
                <div class="list">
                    <div class="item">
                        @IonicFramework
                    </div>
                    <div class="item">
                        @DriftyTeam
                    </div>
                </div>
            </ion-content>
        </ion-view>
    </script>
        {{--<ion-pane>--}}
        {{--<ion-header-bar class="bar-stable" ng-controller="WelcomeCtrl">--}}
            {{--<button class="button button-clear pull-right">--}}
                {{--<i class="ion-android-cart"></i> (Vazio)--}}
            {{--</button>--}}
        {{--</ion-header-bar>--}}
        {{--<div class="bar bar-subheader bar-light item-input-inset">--}}
            {{--<i class="icon ion-search placeholder-icon"></i>--}}
            {{--<input type="search" placeholder="Busca de produtos" ng-model="query">--}}
        {{--</div>--}}
        {{--<ion-content class="has-subheader">--}}

            {{--<div ng-hide="loading">--}}
                {{--<div class="card" ng-controller="ProductsController">--}}
                    {{--<div class="item item-divider">--}}
                        {{--I'm a Header in a Card!--}}
                    {{--</div>--}}
                    {{--<div class="item item-text-wrap">--}}
                        {{--<ion-list>--}}
                            {{--<ion-refresher pulling-text="Deslize para Atualizar" on-refresh="doRefresh()"></ion-refresher>--}}
                            {{--<ion-item class="item item-avatar" ng-repeat="item in products | filter: query">--}}
                                {{--<img ng-hide="item.imagem==null" src="http://delivery.ilhanet.com/images/@{{ item.imagem }}">--}}
                                {{--<h2>@{{ item.nome }}</h2>--}}
                            {{--</ion-item>--}}
                        {{--</ion-list>--}}
                        {{--@foreach($matriz as $linha => $dadoLinha)--}}
                            {{--<div class="row responsive-sm">--}}
                                {{--<div class="col col-33">{{ $matriz[$linha]['nomes'] }}</div>--}}
                                {{--<div class="col col-10">{{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format( isset($matriz[$linha][1])?$matriz[$linha][1]:0 ) }}</div>--}}
                                {{--<div class="col col-10">{{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format( isset($matriz[$linha][2])?$matriz[$linha][2]:0 ) }}</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                        {{--<div class="row responsive-sm">--}}
                            {{--<div class="col col-33">Totais ({{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format(array_sum($somaMatriz)) }} / {{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format($somaMatriz[1]-$somaMatriz[2]) }})</div>--}}
                            {{--<div class="col col-10">{{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format( $somaMatriz[1] ) }}</div>--}}
                            {{--<div class="col col-10">{{ (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->format( $somaMatriz[2] ) }}</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</ion-content>--}}
    {{--</ion-pane>--}}
    </body>
</html>