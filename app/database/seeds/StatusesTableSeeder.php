<?php

class StatusesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('statuses')->insert([
            'id' => 1,
            'name' => 'Aguardando pagamento',
            'description' => 'Estamos aguardando o pagamento.'
        ]);

        DB::table('statuses')->insert([
            'id' => 2,
            'name' => 'Em análise',
            'description' => 'Estamos analisando seu pagamento, a qualquer momento seu pagamento será confirmado.'
        ]);

        DB::table('statuses')->insert([
            'id' => 3,
            'name' => 'Pago',
            'description' => 'Já recebemos seu pagamento, agora você poderá participar do campeonato!'
        ]);

        DB::table('statuses')->insert([
            'id' => 4,
            'name' => 'Disponível',
            'description' => 'O prazo para disputa chegou ao fim, significa que não poderá receber seu dinheiro devolta.'
        ]);

        DB::table('statuses')->insert([
            'id' => 5,
            'name' => 'Em disputa',
            'description' => 'Uma pena que você esteja cancelando, esperamos que participe de outros campeonatos com a gente!'
        ]);

        DB::table('statuses')->insert([
            'id' => 6,
            'name' => 'Dinheiro devolvido',
            'description' => 'Já devolvemos seu dinheiro.'
        ]);

        DB::table('statuses')->insert([
            'id' => 7,
            'name' => 'Cancelado',
            'description' => 'Ocorreu algum erro ou através de sua solicitação a transação foi cancelada.'
        ]);

        DB::table('statuses')->insert([
            'id' => 9,
            'name' => 'Chargeback debitado',
            'description' => 'Já devolvemos seu dinheiro.'
        ]);

        DB::table('statuses')->insert([
            'id' => 9,
            'name' => 'Em contestação',
            'description' => 'Aparentemente você pediu o estorno junto ao seu cartão de crédito, estamos verificando.'
        ]);
    }

}