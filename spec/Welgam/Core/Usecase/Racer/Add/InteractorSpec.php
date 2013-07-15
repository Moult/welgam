<?php

namespace spec\Welgam\Core\Usecase\Racer\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Racer\Add\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Interactor');
    }

    function it_runs_the_interaction_chain($submission)
    {
        $submission->validate()->shouldBeCalled();
        $submission->generate_password()->shouldBeCalled();
        $submission->add()->shouldBeCalled();
        $submission->notify()->shouldBeCalled();
        $this->interact();
    }
}
