<?php

namespace spec\Welgam\Core\Usecase\Competition\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\View\Competition $competition
     * @param Welgam\Core\Usecase\Competition\View\Participant $participant
     */
    function let($competition, $participant)
    {
        $this->beConstructedWith($competition, $participant);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\View\Interactor');
    }

    function it_runs_the_interaction_chain($competition, $participant)
    {
        $competition->has_racers()->shouldBeCalled()->willReturn(TRUE);
        $participant->authorise()->shouldBeCalled();
        $competition->get_details()->shouldBeCalled()->willReturn('details');
        $this->interact()->shouldReturn('details');
    }
}
