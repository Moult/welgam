<?php

namespace spec\Welgam\Core\Usecase\Competition\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Delete\Repository $repository
     */
    function let($competition, $repository)
    {
        $competition->id = 'id';
        $this->beConstructedWith($competition, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Delete\Submission');
    }

    function it_is_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_can_delete($repository)
    {
        $repository->delete_competition('id')->shouldBeCalled();
        $this->delete();
    }
}
