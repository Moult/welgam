<?php

namespace spec\Welgam\Core\Exception;

use PhpSpec\ObjectBehavior;

class AuthorisationSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Exception\Authorisation');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType('Exception');
    }
}
