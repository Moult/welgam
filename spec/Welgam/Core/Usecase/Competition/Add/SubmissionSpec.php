<?php

namespace spec\Welgam\Core\Usecase\Competition\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Add\Repository $repository
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($competition, $repository, $validator)
    {
        $competition->name = 'name';
        $competition->private = 'private';
        $competition->start_date = 'start_date';
        $competition->end_date = 'end_date';
        $this->beConstructedWith($competition, $repository, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Add\Submission');
    }

    function it_is_a_competition()
    {
        $this->shouldHaveType('Welgam\Core\Data\Competition');
    }

    function it_can_validate_submissions($validator)
    {
        $validator->setup(array(
            'name' => 'name',
            'start_date' => 'start_date',
            'end_date' => 'end_date'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->rule('start_date', 'not_empty')->shouldBeCalled();
        $validator->rule('end_date', 'not_empty')->shouldBeCalled();
        $validator->callback('start_date', array($this, 'is_not_in_the_past'))->shouldBeCalled();
        $validator->callback('end_date', array($this, 'is_after_start_date'), array('start_date'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('name', 'start_date', 'end_date'));
        $this->shouldThrow('Welgam\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_can_check_if_a_date_is_not_in_the_past()
    {
        $tomorrow = date('Ymd', strtotime('tomorrow'));
        $this->is_not_in_the_past($tomorrow)->shouldReturn(TRUE);
    }

    function it_checks_if_a_date_is_in_the_past()
    {
        $yesterday = date('Ymd', strtotime('yesterday'));
        $this->is_not_in_the_past($yesterday)->shouldReturn(FALSE);
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

    function it_can_add_submissions($repository)
    {
        $repository->add_competition('name', 'private', 'start_date', 'end_date')->shouldBeCalled()->willReturn('competition_id');
        $this->add();
        $this->get_id()->shouldreturn('competition_id');
    }
}
