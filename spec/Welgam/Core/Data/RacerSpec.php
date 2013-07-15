<?php

namespace spec\Welgam\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RacerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_has_an_id()
    {
        $this->id->shouldBe(NULL);
    }

    function it_has_a_name()
    {
        $this->name->shouldBe(NULL);
    }

    function it_has_a_password()
    {
        $this->password->shouldBe(NULL);
    }

    function it_has_an_email()
    {
        $this->email->shouldBe(NULL);
    }

    function it_has_a_height()
    {
        $this->height->shouldBe(NULL);
    }

    function it_has_a_weight()
    {
        $this->weight->shouldBe(NULL);
    }

    function it_has_a_gender()
    {
        $this->male->shouldBe(NULL);
    }

    function it_has_a_race()
    {
        $this->race->shouldBe(NULL);
    }

    function it_has_a_goal_weight()
    {
        $this->goal_weight->shouldBe(NULL);
    }

    function it_should_belong_to_a_competition()
    {
        $this->competition->shouldBe(NULL);
    }
}
