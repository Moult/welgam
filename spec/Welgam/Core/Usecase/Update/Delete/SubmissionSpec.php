<?php

namespace spec\Welgam\Core\Usecase\Update\Delete;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Update $update
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Update\Delete\Repository $repository
     */
    function let($update, $racer, $repository)
    {
        $racer->id = 'racer_id';
        $racer->password = 'racer_password';
        $update->id = 'id';
        $update->racer = $racer;
        $this->beConstructedWith($update, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Delete\Submission');
    }

    function it_is_an_update()
    {
        $this->shouldHaveType('Welgam\Core\Data\Update');
    }

    function it_authorises_the_racer_who_is_updating($repository)
    {
        $repository->get_update_owner_id_and_password('id')->shouldBeCalled()->willReturn(array('owner_id', 'owner_password'));
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }

    function it_deletes_the_update($repository)
    {
        $repository->delete_update('id')->shouldBeCalled();
        $this->delete();
    }

    function it_checks_if_the_update_was_made_today($repository)
    {
        $today = date('Ymd', strtotime('today'));
        $repository->get_update_date('id')->shouldBeCalled()->willReturn($today);
        $this->is_today()->shouldReturn(TRUE);
    }
}
