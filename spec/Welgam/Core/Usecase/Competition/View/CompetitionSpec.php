<?php

namespace spec\Welgam\Core\Usecase\Competition\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompetitionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\View\Repository $repository
     */
    function let($competition, $repository)
    {
        $competition->id = 'id';
        $this->beConstructedWith($competition, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\View\Competition');
    }

    function it_is_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_can_check_if_it_has_racers($repository)
    {
        $repository->does_competition_have_racers('id')->shouldBeCalled()->willReturn(TRUE);
        $this->has_racers()->shouldReturn(TRUE);
    }

    function it_can_get_details($repository)
    {
        $repository->get_competition_details('id')->shouldBeCalled()->willReturn('details');
        $this->get_details()->shouldReturn('details');
    }
}
