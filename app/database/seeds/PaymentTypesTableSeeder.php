<?php

class PaymentTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('payment_types')->insert([
            'id' => 1,
            'name' => 'MoIP',
            'description' => 'Saldo na Carteira MoIP'
        ]);

        DB::table('payment_types')->insert([
            'id' => 3,
            'name' => 'Visa',
            'description' => 'Bandeira de cartão de crédito Visa'
        ]);

        DB::table('payment_types')->insert([
            'id' => 7,
            'name' => 'American Express',
            'description' => 'Bandeira de cartão de crédito American Express'
        ]);

        DB::table('payment_types')->insert([
            'id' => 5,
            'name' => 'Mastercard',
            'description' => 'Bandeira de cartão de crédito Mastercard'
        ]);

        DB::table('payment_types')->insert([
            'id' => 6,
            'name' => 'Diners',
            'description' => 'Bandeira de cartão de crédito Diners'
        ]);

        DB::table('payment_types')->insert([
            'id' => 8,
            'name' => 'Banco do Brasil',
            'description' => 'Débito em conta Banco do Brasil'
        ]);

        DB::table('payment_types')->insert([
            'id' => 22,
            'name' => 'Bradesco',
            'description' => 'Débito em conta banco Bradesco'
        ]);

        DB::table('payment_types')->insert([
            'id' => 13,
            'name' => 'Itaú',
            'description' => 'Débito em conta banco Itau'
        ]);

        DB::table('payment_types')->insert([
            'id' => 73,
            'name' => 'Boleto Bancário',
            'description' => 'Boleto bancário gerado pela instituição financeira Bradesco'
        ]);

        DB::table('payment_types')->insert([
            'id' => 75,
            'name' => 'Hipercard',
            'description' => 'Bandeira de cartão de crédito Hipercard'
        ]);

        DB::table('payment_types')->insert([
            'id' => 76,
            'name' => 'Oi Paggo',
            'description' => 'Cobrança em conta Oi Paggo'
        ]);

        DB::table('payment_types')->insert([
            'id' => 88,
            'name' => 'Banrisul',
            'description' => 'Débito em conta banco Banrisul'
        ]);
    }
}
