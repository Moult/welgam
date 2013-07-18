<?php

namespace spec\Welgam\Core\Usecase\Update\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompetitionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Update\Add\Repository $repository
     */
    function let($racer, $repository)
    {
        $racer->id = 'racer_id';
        $yesterday = date('Ymd', strtotime('yesterday'));
        $tomorrow = date('Ymd', strtotime('tomorrow'));
        $repository->get_competition_id_and_start_and_end_dates('racer_id')->shouldBeCalled()->willReturn(array('id', $yesterday, $tomorrow));
        $this->beConstructedWith($racer, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add\Competition');
    }

    function it_should_be_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_checks_if_the_competition_is_running()
    {
        $this->is_running()->shouldReturn(TRUE);
    }
}
