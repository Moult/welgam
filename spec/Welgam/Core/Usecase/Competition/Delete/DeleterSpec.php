<?php

namespace spec\Welgam\Core\Usecase\Competition\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleterSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Delete\Repository $repository
     */
    function let($racer, $competition, $repository)
    {
        $racer->id = 'racer_id';
        $racer->password = 'racer_password';
        $competition->id = 'competition_id';
        $racer->competition = $competition;
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Delete\Deleter');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_can_authorise_participant($repository)
    {
        $repository->is_racer_part_of_competition('racer_id', 'racer_password', 'competition_id')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }
}
