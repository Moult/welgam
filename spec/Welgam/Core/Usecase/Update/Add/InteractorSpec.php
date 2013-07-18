<?php

namespace spec\Welgam\Core\Usecase\Update\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Update\Add\Competition $competition
     * @param Welgam\Core\Usecase\Update\Add\Updater $updater
     * @param Welgam\Core\Usecase\Update\Add\Submission $submission
     */
    function let($competition ,$updater, $submission)
    {
        $this->beConstructedWith($competition, $updater, $submission);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add\Interactor');
    }

    function it_runs_the_interaction_chain_where_the_updater_gets_all_the_trophies($competition, $updater, $submission)
    {
        $updater->authorise()->shouldBeCalled();
        $competition->is_running()->shouldBeCalled()->willReturn(TRUE);
        $updater->has_updated_today()->shouldBeCalled()->willReturn(FALSE);
        $submission->validate()->shouldBeCalled();
        $submission->submit()->shouldBeCalled()->willReturn('submission_id');
        $updater->award_attendance_trophy('submission_id')->shouldBeCalled();
        $submission->get_weight()->shouldBeCalled()->willReturn('weight');
        $updater->is_within_bmi_range('weight')->shouldBeCalled()->willReturn(TRUE);
        $updater->award_bmi_trophy('submission_id')->shouldBeCalled();
        $yesterday = date('Ymd', strtotime('yesterday'));
        $updater->get_previous_update_date_and_weight()->shouldBeCalled()->willReturn(array($yesterday, 'previous_weight'));
        $updater->has_made_progress('previous_weight', 'weight')->shouldBeCalled()->willReturn(TRUE);
        $updater->award_progress_trophy('submission_id')->shouldBeCalled();
        $submission->has_food()->shouldBeCalled()->willReturn('food');
        $updater->award_food_trophy('submission_id')->shouldBeCalled();
        $updater->award_combo_trophy('submission_id')->shouldBeCalled();
        $this->interact()->shouldReturn(array('attendance', 'bmi', 'progress', 'food', 'combo'));
    }
}
