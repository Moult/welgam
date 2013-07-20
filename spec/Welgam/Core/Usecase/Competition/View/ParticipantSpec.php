<?php

namespace spec\Welgam\Core\Usecase\Competition\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParticipantSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\View\Repository $repository
     */
    function let($racer, $competition, $repository)
    {
        $racer->id = 'id';
        $racer->password = 'password';
        $competition->id = 'competition_id';
        $racer->competition = $competition;
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\View\Participant');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_authorises_the_racer($repository)
    {
        $repository->does_competition_have_racer('competition_id', 'id', 'password')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }
}
