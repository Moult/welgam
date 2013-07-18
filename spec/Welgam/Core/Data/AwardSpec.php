<?php

namespace spec\Welgam\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AwardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Data\Award');
    }

    function it_is_a_type_of_trophy()
    {
        $this->type->shouldBe(NULL);
    }

    function it_belongs_to_an_update()
    {
        $this->update->shouldBe(NULL);
    }
}
