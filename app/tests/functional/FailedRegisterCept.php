<?php
$I = new FunctionalTester($scenario);
$I->wantTo('register with an existing email');
$I->haveInDatabase('users', [
    'username' => 'usuarioteste1',
    'email' => 'usuarioteste1@gmail.com',
    'password' => 'password',
]);
$I->amOnPage('/register');
$I->fillField('name', 'Diego Felix');
$I->fillField('username', 'usuarioteste1');
$I->fillField('email', 'usuarioteste1@gmail.com');
$I->fillField('password', 'diegofelix');
$I->fillField('password_confirmation', 'diegofelix');
$I->click('#registerButton');
$I->seeInCurrentUrl('/register');
$I->see('o campo email já está sendo utilizado.');
