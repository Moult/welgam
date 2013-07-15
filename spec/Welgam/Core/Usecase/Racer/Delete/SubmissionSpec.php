<?php

namespace spec\Welgam\Core\Usecase\Racer\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Delete\Repository $repository
     */
    function let($racer, $repository)
    {
        $racer->id = 'id';
        $racer->password = 'password';
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Delete\Submission');
    }

    function it_should_be_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_authorises($repository)
    {
        $repository->does_racer_exist('id', 'password')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }

    function it_deletes_the_racer($repository)
    {
        $repository->delete_racer('id')->shouldBeCalled();
        $this->delete();
    }
}
