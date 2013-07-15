<?php

namespace spec\Welgam\Core\Usecase\Competition\Edit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\Edit\Editor $editor
     * @param Welgam\Core\Usecase\Competition\Edit\Submission $submission
     */
    function let($editor, $submission)
    {
        $this->beConstructedWith($editor, $submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Edit\Interactor');
    }

    function it_runs_the_interaction_chain($editor, $submission)
    {
        $editor->authorise_participant()->shouldBeCalled();
        $submission->validate()->shouldBeCalled();
        $submission->update()->shouldBeCalled();
        $this->interact();
    }
}
