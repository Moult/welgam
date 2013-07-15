<?php

namespace spec\Welgam\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Data\Update');
    }

    function it_has_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_has_a_weight()
    {
        $this->weight->shouldBe(NULL);
    }

    function it_has_a_date()
    {
        $this->date->shouldBe(NULL);
    }

    function it_has_a_description_of_food()
    {
        $this->food->shouldBe(NULL);
    }

    function it_belongs_to_a_racer()
    {
        $this->racer->shouldBe(NULL);
    }
}
