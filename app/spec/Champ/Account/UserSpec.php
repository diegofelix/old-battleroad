<?php namespace spec\Champ\Account;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use PhpSpec\Laravel\EloquentModelBehavior;

class UserSpec extends EloquentModelBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Champ\Account\User');
    }

    public function it_should_have_championships()
    {
        $this->championships()->shouldDefineRelationship('hasMany', 'Champ\Championship\Championship');
    }

    public function it_should_have_a_profile()
    {
        $this->profile()->shouldDefineRelationship('hasOne', 'Champ\Account\Profile');
    }

    public function it_should_have_joins()
    {
        $this->joins()->shouldDefineRelationship('hasMany', 'Champ\Join\Join');
    }
}
