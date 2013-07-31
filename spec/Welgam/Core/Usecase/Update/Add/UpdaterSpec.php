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
        $repository->get_weight_and_height_and_goal_weight('id')->shouldBeCalled()->willReturn(array(80, 180, 70));
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

    function it_can_award_the_attendance_trophy_for_updating($repository)
    {
        $repository->add_award('attendance', 'submission_id')->shouldBeCalled();
        $this->award_attendance_trophy('submission_id');
    }

    function it_checks_if_is_within_bmi_range()
    {
        $this->is_within_bmi_range(50)->shouldReturn(FALSE);
        $this->is_within_bmi_range(70)->shouldReturn(TRUE);
    }

    function it_can_award_the_bmi_trophy($repository)
    {
        $repository->add_award('bmi', 'submission_id')->shouldBeCalled();
        $this->award_bmi_trophy('submission_id');
    }

    function it_can_get_the_previous_date_and_weight($repository)
    {
        $repository->get_previous_update_date_and_weight('id')->shouldBeCalled()->willReturn(array('previous_update_date', 'previous_update_weight'));
        $this->get_previous_update_date_and_weight()->shouldReturn(array('previous_update_date', 'previous_update_weight'));
    }

    function it_checks_whether_it_has_made_progress_towards_the_goal_weight()
    {
        $this->has_made_progress(80, 79)->shouldReturn(TRUE);
        $this->has_made_progress(80, 81)->shouldReturn(FALSE);
    }

    function it_checks_whether_or_not_the_updater_is_on_target_towards_the_goal($repository)
    {
        $today_minus_ten_days = date('Ymd', strtotime('-10 day'));
        $today_plus_ten_days = date('Ymd', strtotime('+10 day'));
        $repository->get_competition_start_and_end_date('id')->shouldBeCalled()->willReturn(array($today_minus_ten_days, $today_plus_ten_days));
        $this->is_on_target(73)->shouldReturn(TRUE);
        $this->is_on_target(77)->shouldReturn(FALSE);
        $this->is_on_target(75)->shouldReturn(TRUE);
    }

    function it_can_award_the_progress_trophy($repository)
    {
        $repository->add_award('progress', 'submission_id')->shouldBeCalled();
        $this->award_progress_trophy('submission_id');
    }

    function it_can_award_the_food_trophy($repository)
    {
        $repository->add_award('food', 'submission_id')->shouldBeCalled();
        $this->award_food_trophy('submission_id');
    }

    function it_can_award_the_combo_trophy($repository)
    {
        $repository->add_award('combo', 'submission_id')->shouldBeCalled();
        $this->award_combo_trophy('submission_id');
    }

    function it_can_award_the_lead_trophy($repository)
    {
        $repository->add_award('lead', 'submission_id')->shouldBeCalled();
        $this->award_lead_trophy('submission_id');
    }
}
