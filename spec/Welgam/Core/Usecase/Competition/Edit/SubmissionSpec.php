<?php

namespace spec\Welgam\Core\Usecase\Competition\Edit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Edit\Repository $repository
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($competition, $repository, $validator)
    {
        $competition->id = 'id';
        $competition->name = 'name';
        $competition->end_date = 'end_date';
        $this->beConstructedWith($competition, $repository, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Edit\Submission');
    }

    function it_should_be_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_should_get_id()
    {
        $this->get_id()->shouldReturn('id');
    }

    function it_can_validate($repository, $validator)
    {
        $repository->get_competition_start_date('id')->shouldBeCalled()->willReturn('start_date');
        $validator->setup(array(
            'name' => 'name',
            'start_date' => 'start_date',
            'end_date' => 'end_date'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->callback('end_date', array($this, 'is_after_start_date'), array('end_date', 'start_date'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('name', 'start_date', 'end_date'));
        $this->shouldThrow('Welgam\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_can_check_if_end_date_is_after_start_date()
    {
        $tomorrow = date('Ymd', strtotime('tomorrow'));
        $today = date('Ymd', strtotime('today'));
        $this->is_after_start_date($tomorrow, $today)->shouldReturn(TRUE);
    }

    function it_checks_if_end_date_is_before_start_date()
    {
        $tomorrow = date('Ymd', strtotime('tomorrow'));
        $today = date('Ymd', strtotime('today'));
        $this->is_after_start_date($today, $tomorrow)->shouldReturn(FALSE);
    }

    function it_updates_the_submission($repository)
    {
        $repository->update_competition('id', 'name', 'end_date')->shouldBeCalled();
        $this->update();
    }
}
