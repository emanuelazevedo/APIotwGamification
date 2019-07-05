<?php

use Illuminate\Database\Seeder;
// use Image;

class BadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //seed de missoes
        //VIAGENS
        \App\Badge::create([
            'name' => 'Entrega',
            'description' => 'Realizar 12 entregas',
            // 'icon' => Image::make('public/images/badges/badge-entregas.png'),
            'level' => 1,
            'finalScore' => 12,
        ]);
        \App\Badge::create([
            'name' => 'Entrega',
            'description' => 'Realizar 20 entregas',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 20,
        ]);

        \App\Badge::create([
            'name' => 'Entrega',
            'description' => 'Realizar 28 entregas',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 28,
        ]);

        \App\Badge::create([
            'name' => 'Volume',
            'description' => 'Realizar 12 entregas com diferentes volumes de produtos',
            // 'icon' => Image::make('public/images/badges/badge-volume.png'),
            'level' => 1,
            'finalScore' => 12,
        ]);
        \App\Badge::create([
            'name' => 'Volume',
            'description' => 'Realizar 20 entregas com diferentes volumes de produtos',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 20,
        ]);
        \App\Badge::create([
            'name' => 'Volume',
            'description' => 'Realizar 28 entregas com diferentes volumes de produtos',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 28,
        ]);

        \App\Badge::create([
            'name' => 'Distância',
            'description' => 'Realizar 12 km para efetuar uma entrega',
            // 'icon' => Image::make('public/images/badges/badge-distancia.png'),
            'level' => 1,
            'finalScore' => 12,
        ]);
        \App\Badge::create([
            'name' => 'Distância',
            'description' => 'Realizar 20 km para efetuar uma entrega',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 20,
        ]);
        \App\Badge::create([
            'name' => 'Distância',
            'description' => 'Realizar 28 km para efetuar uma entrega',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 28,
        ]);

        //LOCAIS
        \App\Badge::create([
            'name' => 'Explorador',
            'description' => 'Realizar 3 entregas em cidades diferentes',
            // 'icon' => Image::make('public/images/badges/badge-explorador.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Explorador',
            'description' => 'Realizar 6 entregas  em cidades diferentes',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Explorador',
            'description' => 'Realizar 10 entregas em cidades diferentes',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        \App\Badge::create([
            'name' => 'Viciado',
            'description' => 'Realizar 3 entregas na mesma cidade',
            // 'icon' => Image::make('public/images/badges/badge-viciado.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Viciado',
            'description' => 'Realizar 6 entregas na mesma cidade',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Viciado',
            'description' => 'Realizar 10 entregas na mesma cidade',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        //BOM CONDUTOR
        \App\Badge::create([
            'name' => 'Exemplar',
            'description' => 'Aceitar 3 pedidos',
            // 'icon' => Image::make('public/images/badges/badge-exemplar.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Exemplar',
            'description' => 'Aceitar 6 pedidos',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Exemplar',
            'description' => 'Aceitar 10 pedidos',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        \App\Badge::create([
            'name' => 'Leal',
            'description' => 'Realizar 3 entregas ao mesmo cliente',
            // 'icon' => Image::make('public/images/badges/badge-leal.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Leal',
            'description' => 'Realizar 6 entregas ao mesmo cliente',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Leal',
            'description' => 'Realizar 10 entregas ao mesmo cliente',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        \App\Badge::create([
            'name' => 'Avaliação',
            'description' => 'Receber 3 avaliações 5 estrelas',
            // 'icon' => Image::make('public/images/badges/badge-satisfacao.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Avaliação',
            'description' => 'Receber 6 avaliações 5 estrelas',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Avaliação',
            'description' => 'Receber 10 avaliações 5 estrelas',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        \App\Badge::create([
            'name' => 'Pontualidade',
            'description' => 'Entregar 3 encomendas no tempo estipulado',
            // 'icon' => Image::make('public/images/badges/badge-pontual.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Pontualidade',
            'description' => 'Entregar 6 encomendas no tempo estipulado',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Pontualidade',
            'description' => 'Entregar 10 encomendas no tempo estipulado',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);

        \App\Badge::create([
            'name' => 'Disponibilidade',
            'description' => 'Aceitar 3 entregas na última semana',
            // 'icon' => Image::make('public/images/badges/badge-disponivel.png'),
            'level' => 1,
            'finalScore' => 3,
        ]);
        \App\Badge::create([
            'name' => 'Disponibilidade',
            'description' => 'Aceitar 6 entregas na última semana',
            // 'icon' => 'viagens',
            'level' => 2,
            'finalScore' => 6,
        ]);
        \App\Badge::create([
            'name' => 'Disponibilidade',
            'description' => 'Aceitar 10 entregas na última semana',
            // 'icon' => 'viagens',
            'level' => 3,
            'finalScore' => 10,
        ]);
    }
}
