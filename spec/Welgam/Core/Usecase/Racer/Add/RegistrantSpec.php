<?php

namespace spec\Welgam\Core\Usecase\Racer\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegistrantSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Racer\Add\Repository $repository
     */
    function let($racer, $competition, $repository)
    {
        $racer->id = 'id';
        $racer->password = 'password';
        $competition->id = 'competition_id';
        $racer->competition = $competition;
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Registrant');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_can_authorise($repository)
    {
        $repository->does_racer_participate_in_competition('id', 'password', 'competition_id')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }
}
