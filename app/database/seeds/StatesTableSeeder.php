<?php

use Champ\State\State;

class StatesTableSeeder extends Seeder {

    protected $states = [
        // default state selected
        ['abbr' => '', 'name' => '[Selecione um Estado]'],
        ['abbr' => 'RO', 'name' => 'RONDÔNIA'],
        ['abbr' => 'AC', 'name' => 'ACRE'],
        ['abbr' => 'AM', 'name' => 'AMAZONAS'],
        ['abbr' => 'RR', 'name' => 'RORAIMA'],
        ['abbr' => 'PA', 'name' => 'PARÁ'],
        ['abbr' => 'AP', 'name' => 'AMAPÁ'],
        ['abbr' => 'TO', 'name' => 'TOCANTINS'],
        ['abbr' => 'MA', 'name' => 'MARANHÃO'],
        ['abbr' => 'PI', 'name' => 'PIAUÍ'],
        ['abbr' => 'CE', 'name' => 'CEARÁ'],
        ['abbr' => 'RN', 'name' => 'RIO GRANDE DO NORTE'],
        ['abbr' => 'PB', 'name' => 'PARAÍBA'],
        ['abbr' => 'PE', 'name' => 'PERNAMBUCO'],
        ['abbr' => 'AL', 'name' => 'ALAGOAS'],
        ['abbr' => 'SE', 'name' => 'SERGIPE'],
        ['abbr' => 'BA', 'name' => 'BAHIA'],
        ['abbr' => 'MG', 'name' => 'MINAS GERAIS'],
        ['abbr' => 'ES', 'name' => 'ESPIRITO SANTO'],
        ['abbr' => 'RJ', 'name' => 'RIO DE JANEIRO'],
        ['abbr' => 'SP', 'name' => 'SÃO PAULO'],
        ['abbr' => 'PR', 'name' => 'PARANÁ'],
        ['abbr' => 'SC', 'name' => 'SANTA CATARINA'],
        ['abbr' => 'RS', 'name' => 'RIO GRANDE DO SUL'],
        ['abbr' => 'MS', 'name' => 'MATO GROSSO DO SUL'],
        ['abbr' => 'MT', 'name' => 'MATO GROSSO'],
        ['abbr' => 'GO', 'name' => 'GOIÁS'],
        ['abbr' => 'DF', 'name' => 'DISTRITO FEDERAL']
    ];

	public function run()
	{
		foreach ($this->states as $state) {
            State::create($state);
        }
    }
}