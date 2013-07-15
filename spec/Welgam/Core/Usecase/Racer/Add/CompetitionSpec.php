<?php

namespace spec\Welgam\Core\Usecase\Racer\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompetitionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Racer\Add\Repository $repository
     */
    function let($competition, $repository)
    {
        $competition->id = 'id';
        $this->beConstructedWith($competition, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Competition');
    }

    function it_should_be_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_can_check_whether_or_not_it_has_racers($repository)
    {
        $repository->does_competition_have_racers('id')->shouldBeCalled()->willReturn(TRUE);
        $this->has_racers()->shouldReturn(TRUE);
    }
}
