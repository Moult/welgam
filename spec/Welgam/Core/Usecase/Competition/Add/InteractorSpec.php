<?php

namespace spec\Welgam\Core\Usecase\Competition\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\Add\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Add\Interactor');
    }

    function it_runs_the_interaction_chain($submission)
    {
        $submission->validate()->shouldBeCalled();
        $submission->add()->shouldBeCalled();
        $submission->get_id()->shouldBeCalled()->willReturn('submission_id');
        $this->interact()->shouldReturn('submission_id');
    }
}
