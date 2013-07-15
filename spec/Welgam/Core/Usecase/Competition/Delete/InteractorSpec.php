<?php

namespace spec\Welgam\Core\Usecase\Competition\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\Delete\Deleter $deleter
     * @param Welgam\Core\Usecase\Competition\Delete\Submission $submission
     */
    function let($deleter, $submission)
    {
        $this->beConstructedWith($deleter, $submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Delete\Interactor');
    }

    function it_runs_the_interaction_chain($deleter, $submission)
    {
        $deleter->authorise()->shouldBeCalled();
        $submission->delete()->shouldBeCalled();
        $this->interact();
    }
}
