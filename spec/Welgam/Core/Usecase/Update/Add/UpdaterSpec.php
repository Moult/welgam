<?php

namespace spec\Welgam\Core\Usecase\Update\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdaterSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Update\Add\Repository $repository
     */
    function let($racer, $repository)
    {
        $racer->id = 'id';
        $racer->password = 'password';
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add\Updater');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_authorises_the_updater($repository)
    {
        $repository->does_racer_exist('id', 'password')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }

    function it_checks_whether_or_not_it_already_has_an_update_today($repository)
    {
        $today = date('Ymd', strtotime('today'));
        $repository->does_update_exist($today, 'id')->shouldBeCalled()->willReturn(TRUE);
        $this->has_updated_today()->shouldReturn(TRUE);
    }
}
