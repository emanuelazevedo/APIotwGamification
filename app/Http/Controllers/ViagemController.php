<?php

namespace App\Http\Controllers;

use App\Viagem;
use Illuminate\Http\Request;
use App\Http\Requests\ViagemCreateRequest;
use App\Http\Requests\ViagemUpdateRequest;
use Validator;

use Illuminate\Support\Facades\DB;

use App\Produto;

use App\Review;
use App\User;
use App\Estado;

use App\Objective;
use App\Mission;

use App\UserBadge;
use App\Badge;

use Auth;

// use vendor\qcod\src\Badge;

// use App\Gamify\Points\ViagemDone;
// use App\Gamify\Badges\FirstTrip;

class ViagemController extends Controller
{
    /**
     * Listar todas as Viagens
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $viagem = Viagem::all();

        return $viagem;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Criar uma Viagem
     *
     * @bodyParam origem string required Origem da viagem
     * @bodyParam destino string required Destino da viagem
     * @bodyParam data date required Data da viagem
     * @bodyParam horaInicio time required Hora de inicio da viagem
     * @bodyParam horaFim time required Hora de fim da viagem
     * @bodyParam user_id integer required Criador da viagem
     * @bodyParam tipo_id integer required Tipo de viagem
     * @bodyParam preco integer Preco da viagem caso seja viagem criada
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ViagemCreateRequest $request)
    {
        //
        $dataViagem = $request->only(['origem', 'destino', 'data', 'horaInicio', 'horaFim', 'tipo_id', 'preco']);
        $dataViagem['estado_id'] = 1;
        $user = Auth::user();

        $dataViagem['user_id'] = $user->id;

        // se for viagem criada
        if($request->tipo_id == 1){

            $viagem = Viagem::create($dataViagem);
            return Response([
                'status' => 0,
                'dataViagem' => $viagem,
                'msg' => 'ok'
                ], 200);
        }


    }

    /**
     * Mostrar uma Viagem
     *
     * @param  \App\Viagem  $viagem
     * @return \Illuminate\Http\Response
     */
    public function show(Viagem $viagem)
    {
        //
        $viagem->user;

        $user = $viagem['user']['id'];
        $reviews = Review::where('user_id', $user)->avg('nota');
        $viagem['user']['nota'] = $reviews;

        $viagensFin = Viagem::where('user_id', $user)
                    ->where('estado_id', 3)
                    ->orWhere('estado_id', 4)
                    ->count();

        $viagem['user']['totalViagens'] = $viagensFin;
        $viagem->estado;

        return $viagem;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Viagem  $viagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Viagem $viagem)
    {
        //

    }

    /**
     * Editar uma Viagem
     *
     * @bodyParam estado integer required id Estado da viagem
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Viagem  $viagem
     * @return \Illuminate\Http\Response
     */
    public function update(ViagemUpdateRequest $request, Viagem $viagem)
    {
        //
        //estados sao: pendente, em viagem, concluido, avaliada
        $data = $request->only(['estado']);
        $viagem->estado_id = (int)$data['estado'];


        $produtos = Produto::where('viagems_id', $viagem['id'])->get();
        $produtosCount = count($produtos);

        $user = User::find($viagem->user_id);

        foreach($produtos as $produto){
            //dar pontos ao criador da viagem, ciclo foreach para os produtos e fazer contas
            if($viagem->estado_id == 4){
                //se for a primeira viagem dá crachá ao user
                // givePoint(new ViagemDone($viagem));
                $user['xp'] = $user['xp'] + 10;
            }
        }

        $viagem->save();

        // // missoes de viagens e produtos
        // $objectives = Objective::where('user_id', Auth::user()->id)->get();
        // foreach($objectives as $objective){
        //     //verifica se os objetivos ja estao cumpridos
        //     if($objective['state'] == false){
        //         $mission = Misson::find($objective->mission_id);
        //         //verificar tipo de missao e valores
        //         $typeOfMission = $mission['typeOfMission'];
        //         $finalResult = $mission['finalResult'];

        //         // TODO Verificar se esta parte funciona e migrar
        //         if($typeOfMission == 'viagem'){
        //             $objective['score']+=100;
        //             if($finalResult == $objective['score']){
        //                 $objective['state'] = true;

        //                 // adicionar pontos pela missao
        //                 $xp = $mission['xp'] / 10;
        //                 for($i = 0; i<$xp; $i++){
        //                     $user['xp'] = $user['xp'] + 10;
        //                 }
        //             }
        //         }
        //         if($typeOfMission == 'produto'){
        //             $objective['score']+=100;
        //             if($finalResult == $objective['score']){
        //                 $objective['state'] = true;

        //                 // adicionar pontos pela missao
        //                 $xp = $mission['xp'] / 10;
        //                 for($i = 0; i<$xp; $i++){
        //                     $user['xp'] = $user['xp'] + 10;
        //                 }
        //             }
        //         }
        //         if($typeOfMission == 'produtoPorViagem'){
        //             $objective['score']+=100;
        //             if($finalResult == $objective['score']){
        //                 $objective['state'] = true;

        //                 // adicionar pontos pela missao
        //                 $xp = $mission['xp'] / 10;
        //                 for($i = 0; i<$xp; $i++){
        //                     $user['xp'] = $user['xp'] + 10;
        //                 }
        //             }
        //         }


        //     }
        //     // objetive é alterado para manter registo de quantos pontos o user tem
        //     $objective->save();
        // }

        //ACEITAR VIAGENS - NAO ESTA A FUNCIONAR TOTALMENTE - FALTA SER FEITO A CADA SEMANA
        if((int)$data['estado'] == 2){
            $user_badges = UserBadge::where('user_id', $viagem->user_id)->get();

            foreach($user_badges as $user_badge){
                $badge = Badge::find($user_badge->badge_id);

                if($badge['name'] == 'Exemplar'){

                    //VERIFICA TODOS OS BADGES DE EXEMPLAR
                    if($user_badge['state'] == false){
                        $user_badge['score'] = $user_badge['score'] + 1 ;
                        if($badge['finalScore'] == $user_badge['score']){
                            $user_badge['state'] = true;
                            $user['xp'] = $user['xp'] + 300;
                        }
                    }
                }

                // ESTA IGUAL AO DO EXEMPLAR
                // if($badge['name'] == 'Disponibilidade'){

                //     //VERIFICA TODOS OS BADGES DE DISPONIBILIDADE
                //     if($user_badge['state'] == false){
                //         $user_badge['score'] = $user_badge['score'] + 1 ;
                //         if($badge['finalScore'] == $user_badge['score']){
                //             $user_badge['state'] = true;
                //         }
                //     }
                // }
            }
        }

        //TERMINAR VIAGENS
        if((int)$data['estado'] == 4){
            $user_badges = UserBadge::where('user_id', $viagem->user_id)->get();

            foreach($user_badges as $user_badge){
                $badge = Badge::find($user_badge->badge_id);

                if($badge['name'] == 'Entrega'){

                    //VERIFICA TODOS OS BADGES DE EXEMPLAR
                    if($user_badge['state'] == false){
                        $user_badge['score'] = $user_badge['score'] + 1 ;
                        if($badge['finalScore'] == $user_badge['score']){
                            $user_badge['state'] = true;
                            $user['xp'] = $user['xp'] + 300;
                        }
                    }
                }

                /*
                //VOLUME AINDA TEM DE SER TRATADO NA PARTE DO PRODUTO NA BD
                if($badge['name'] == 'Volume'){
                    $lastViagens = Viagem::where()
                    //VERIFICA TODOS OS BADGES DE
                    if($user_badge['state'] == false){
                        $user_badge['score'] = $user_badge['score'] + 1 ;

                        if($badge['finalScore'] == $user_badge['score']){
                            $user_badge['state'] = true;
                        }
                    }
                }*/

                //DISTANCIA AINDA TEM DE SER TRATADO NA PARTE DA VIAGEM NA BD E NO REACT
                //2 DO LOCAIS AINDA TEM DE SER TRATADO NA PARTE DA VIAGEM NA BD E NO REACT


                // if($badge['name'] == 'Leal'){
                //     //como verificar quem é o dono do produto?
                //     // $ultimasViagens = Viagem::where
                //     //VERIFICA TODOS OS BADGES DE LEALDADE
                //     if($user_badge['state'] == false){
                //         $user_badge['score'] = $user_badge['score'] + 1 ;
                //         if($badge['finalScore'] == $user_badge['score']){
                //             $user_badge['state'] = true;
                //         }
                //     }
                // }

                //AVALIAÇOES TEM DE SER NAS REVIEWS?

                if($badge['name'] == 'Pontualidade'){
                    //como verificar quem é o dono do produto?
                    // $ultimasViagens = Viagem::where
                    //VERIFICA TODOS OS BADGES DE LEALDADE
                    if($user_badge['state'] == false){
                        if($viagem->horaFim <= date('H:i')){
                            $user_badge['score'] = $user_badge['score'] + 1 ;
                            if($badge['finalScore'] == $user_badge['score']){
                                $user_badge['state'] = true;
                                $user['xp'] = $user['xp'] + 300;
                            }
                        }
                    }
                }
            }

            //CLIENTE DÁ REVIEW AO CONDUTOR
            $dataReview = ['nota'=>5, 'comentario'=>'gostei muito', 'user_id'=>1, 'viagems_id'=>1];
            $review = Review::create($dataReview);

            $dataReview = ['nota'=>5, 'comentario'=>'adorei', 'user_id'=>1, 'viagems_id'=>1];
            $review = Review::create($dataReview);

            $reviewsViagem = Review::where('viagems_id'->$viagem->id)->get();
            foreach($reviewsViagem as $reviewViagem){

                foreach($user_badges as $user_badge){

                    $badge = Badge::find($user_badge->badge_id);
                    if($badge['name'] == 'Avaliação'){

                        if($reviewViagem['nota'] == 5){

                            //VERIFICA TODOS OS BADGES DE EXEMPLAR
                            if($user_badge['state'] == false){
                                $user_badge['score'] = $user_badge['score'] + 1 ;
                                if($badge['finalScore'] == $user_badge['score']){
                                    $user_badge['state'] = true;
                                    $user['xp'] = $user['xp'] + 300;
                                }
                            }
                        }
                    }
                }
            }


        }

        //VOLUME TEM DE SER REVISTO
        //DISTANCIA PRECISA DA API DA GOOGLE
        //EXPLORADOR E VICIADO TAMBEM PRECISAM DA API DA GOOGLE
        //LEAL PRECISA DE VERIFICAR O DONO DO PRODUTO
        //AVALIAÇAO TEM DE SER NAS REVIEWS

        return Response([
          'status' => 0,
          'data' => $viagem,
          'msg' => 'ok'
        ], 200);
    }

    /**
     * Remover uma Viagem
     *
     * @param  \App\Viagem  $viagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viagem $viagem)
    {
        //
        Viagem::destroy($viagem['id']);
        return Response([
          'status' => 0,
          'data' => $viagem,
          'msg' => 'ok'
        ], 200);
    }


    /**
     * Pesquisar por Viagens
     *
     * @bodyParam origem string required Origem da viagem
     * @bodyParam destino string required Destino da viagem
     * @bodyParam data date required Data da viagem
     * @bodyParam horaInicio time required Hora de inicio da viagem
     * @bodyParam horaFim time required Hora de fim da viagem
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $listaViagens = DB::table('viagems')
        ->where('tipo_id', 1)
        ->where('origem', $request->origem)
        ->where('destino', $request->destino)
        ->where('data', $request->data)
        ->where('horaInicio', $request->horaInicio)
        ->where('horaFim', $request->horaFim)
        // ->leftjoin('users', 'viagems.user_id', "=", 'users.id')
        ->get();

        $lista = json_decode($listaViagens, true);
        $listaViagens = array();

        foreach($lista as $viagem){
            $user = DB::table('users')
            ->where('id', $viagem['user_id'])->get();

            $viagem['user'] = $user;

            $reviews = Review::where('user_id', $viagem['user_id'])->avg('nota');
            $viagem['nota'] = $reviews;
            $listaViagens[] = $viagem;
        }




        return Response(array('listaViagens' => $listaViagens));
    }


}
