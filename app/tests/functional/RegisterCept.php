<?php
$I = new FunctionalTester($scenario);
$I->wantTo('sign up');
$I->amOnPage('/');
$I->click('Cadastre-se, é grátis!');
$I->canSeeInCurrentUrl('/register');
$I->fillField('name', 'Diego Felix');
$I->fillField('username', 'usuarioteste1');
$I->fillField('email', 'usuarioteste1@gmail.com');
$I->fillField('password', 'diegofelix');
$I->fillField('password_confirmation', 'diegofelix');
$I->click('#registerButton');
$I->seeLink('Minhas inscrições', 'a');
$I->canSeeInDatabase('users', ['username' => 'usuarioteste1']);