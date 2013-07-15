<?php

namespace spec\Welgam\Core\Usecase\Update\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Update\Add\Updater $updater
     * @param Welgam\Core\Usecase\Update\Add\Submission $submission
     */
    function let($updater, $submission)
    {
        $this->beConstructedWith($updater, $submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add\Interactor');
    }

    function it_runs_the_interaction_chain($updater, $submission)
    {
        $updater->authorise()->shouldBeCalled();
        $updater->has_updated_today()->shouldBeCalled()->willReturn(FALSE);
        $submission->validate()->shouldBeCalled();
        $submission->submit()->shouldBeCalled();
        $this->interact();
    }
}
