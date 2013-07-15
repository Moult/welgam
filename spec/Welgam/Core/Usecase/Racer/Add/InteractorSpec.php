<?php

namespace spec\Welgam\Core\Usecase\Racer\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Racer\Add\Competition $competition
     * @param Welgam\Core\Usecase\Racer\Add\Registrant $registrant
     * @param Welgam\Core\Usecase\Racer\Add\Submission $submission
     */
    function let($competition, $registrant, $submission)
    {
        $this->beConstructedWith($competition, $registrant, $submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Interactor');
    }

    function it_runs_the_interaction_chain($competition, $registrant, $submission)
    {
        $competition->has_racers()->shouldBeCalled()->willReturn(TRUE);
        $registrant->authorise()->shouldBeCalled();
        $submission->validate()->shouldBeCalled();
        $submission->generate_password()->shouldBeCalled();
        $submission->add()->shouldBeCalled();
        $submission->notify()->shouldBeCalled();
        $this->interact();
    }
}
