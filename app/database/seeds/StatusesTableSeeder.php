<?php

class StatusesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('statuses')->insert([
            'id' => 1,
            'name' => 'Autorizado',
            'description' => 'Pagamento autorizado pelo pagador, porém ainda não creditado para o recebedor em razão do floating'
        ]);

        DB::table('statuses')->insert([
            'id' => 2,
            'name' => 'Iniciado',
            'description' => 'Pagamento foi iniciado, mas não existem garantias de que será finalizado'
        ]);

        DB::table('statuses')->insert([
            'id' => 3,
            'name' => 'BoletoImpresso',
            'description' => 'Pagamento ainda não foi confirmado, porém boleto bancário foi impresso e pode ter sido pago (não existem garantias de que será pago)'
        ]);

        DB::table('statuses')->insert([
            'id' => 4,
            'name' => 'Concluido',
            'description' => 'Pagamento foi concluído, dinheiro debitado do pagador e creditado para o recebedor'
        ]);

        DB::table('statuses')->insert([
            'id' => 5,
            'name' => 'Cancelado',
            'description' => 'Pagamento foi cancelado por quem estava pagando'
        ]);

        DB::table('statuses')->insert([
            'id' => 6,
            'name' => 'EmAnalise',
            'description' => 'Pagamento autorizado pelo pagador, mas está em análise e não tem garantias de que será autorizado'
        ]);

        DB::table('statuses')->insert([
            'id' => 7,
            'name' => 'Estornado',
            'description' => 'Pagamento foi concluído, dinheiro creditado para o recebedor, porém estornado para o cartão de crédito do pagador'
        ]);

        DB::table('statuses')->insert([
            'id' => 9,
            'name' => 'Reembolsado',
            'description' => 'Pagamento foi concluído, dinheiro creditado para o recebedor, porém houve o reembolso para a Carteira Moip do pagador'
        ]);
    }

}