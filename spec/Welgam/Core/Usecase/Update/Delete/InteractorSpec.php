<?php

namespace spec\Welgam\Core\Usecase\Update\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Update\Delete\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Delete\Interactor');
    }

    function it_runs_the_interaction_chain($submission)
    {
        $submission->authorise()->shouldBeCalled();
        $submission->delete()->shouldBeCalled();
        $this->interact();
    }
}
