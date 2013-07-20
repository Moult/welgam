<?php

namespace spec\Welgam\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompetitionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_has_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_has_a_name()
    {
        $this->name->shouldBe(NULL);
    }

    function it_has_a_privacy_option()
    {
        $this->private->shouldBe(NULL);
    }

    function it_has_a_start_date()
    {
        $this->start_date->shouldBe(NULL);
    }

    function it_has_an_end_date()
    {
        $this->end_date->shouldBe(NULL);
    }

    function it_has_a_stake()
    {
        $this->stake->shouldBe(NULL);
    }
}
