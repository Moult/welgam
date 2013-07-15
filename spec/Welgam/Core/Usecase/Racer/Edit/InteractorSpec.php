<?php

namespace spec\Welgam\Core\Usecase\Racer\Edit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Racer\Edit\Submission $submission
     */
    function let($submission)
    {
        $this->beConstructedWith($submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Edit\Interactor');
    }

    function it_runs_the_interaction_chain($submission)
    {
        $submission->authorise()->shouldBeCalled();
        $submission->validate()->shouldBeCalled();
        $submission->update()->shouldBeCalled();
        $this->interact();
    }
}
