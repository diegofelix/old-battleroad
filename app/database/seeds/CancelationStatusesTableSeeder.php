<?php

class CancelationStatusesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cancelation_statuses')->insert([
            'id' => 1,
            'name' => 'Dados inválidos',
            'description' => 'Dados informados inválidos. Você digitou algo errado durante o preenchimento dos dados do seu Cartão. Certifique-se de que está usando o Cartão correto e faça uma nova tentativa.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 2,
            'name' => 'Falha na comunicação com o Banco Emissor',
            'description' => 'Houve uma falha de comunicação com o Banco Emissor do seu Cartão, tente novamente.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 3,
            'name' => 'Política do Banco Emissor',
            'description' => 'O pagamento não foi autorizado pelo Banco Emissor do seu Cartão. Entre em contato com o Banco para entender o motivo e refazer o pagamento.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 4,
            'name' => 'Cartão vencido',
            'description' => 'A validade do seu Cartão expirou. Escolha outra forma de pagamento para concluir o pagamento.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 5,
            'name' => 'Transação não autorizada',
            'description' => 'O pagamento não foi autorizado. Entre em contato com o Banco Emissor do seu Cartão.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 6,
            'name' => 'Transação duplicada',
            'description' => 'Esse pagamento já foi realizado. Caso não encontre nenhuma referência ao pagamento anterior, por favor entre em contato com o nosso Atendimento.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 7,
            'name' => 'Política do Moip',
            'description' => 'O pagamento não foi autorizado. Para mais informações, entre em contato com o nosso atendimento.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 8,
            'name' => 'Solicitado pelo Comprador',
            'description' => 'O Comprador solicitou o cancelamento da transação diretamente ao Moip.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 9,
            'name' => 'Solicitado pelo Vendedor',
            'description' => 'O Vendedor solicitou o cancelamento da transação diretamente ao Moip'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 10,
            'name' => 'Transação não processada',
            'description' => 'O pagamento não pode ser processado. Por favor, tente novamente. Caso o erro persista, entre em contato com o nosso atendimento.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 11,
            'name' => 'Desconhecido',
            'description' => 'Houve uma falha de comunicação com o Banco Emissor do seu Cartão, tente novamente.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 12,
            'name' => 'Política de segurança do Banco Emissor',
            'description' => 'Pagamento não autorizado para este Cartão. Entre em contato com o Banco Emissor para mais esclarecimentos.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 13,
            'name' => 'Valor inválido',
            'description' => 'Pagamento não autorizado. Entre em contato com o Atendimento e informe o ocorrido.'
        ]);

        DB::table('cancelation_statuses')->insert([
            'id' => 14,
            'name' => 'Política de segurança do Moip',
            'description' => 'Pagamento não autorizado'
        ]);
    }
}
