<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Aguardando pagamento',
            'description' => 'Estamos aguardando o pagamento.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Em análise',
            'description' => 'Estamos analisando seu pagamento, a qualquer momento seu pagamento será confirmado.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Pago',
            'description' => 'Já recebemos seu pagamento, agora você poderá participar do campeonato!'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Disponível',
            'description' => 'O prazo para disputa chegou ao fim, significa que não poderá receber seu dinheiro devolta.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Em disputa',
            'description' => 'Uma pena que você esteja cancelando, esperamos que participe de outros campeonatos com a gente!'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Dinheiro devolvido',
            'description' => 'Já devolvemos seu dinheiro.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Cancelado',
            'description' => 'Ocorreu algum erro com o Pagseguro ou com a instituição financeira, tente novamente.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Chargeback debitado',
            'description' => 'Já devolvemos seu dinheiro.'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Em contestação',
            'description' => 'Aparentemente você pediu o estorno junto ao seu cartão de crédito, estamos verificando.'
        ]);
    }

}