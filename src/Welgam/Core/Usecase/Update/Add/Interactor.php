<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;
use Welgam\Core\Data;

class Interactor
{
    private $competition;
    private $updater;
    private $submission;

    public function __construct(Competition $competition, Updater $updater, Submission $submission)
    {
        $this->competition = $competition;
        $this->updater = $updater;
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->updater->authorise();
        if ( ! $this->competition->is_running() OR $this->updater->has_updated_today())
            return;

        $this->submission->validate();
        $submission_id = $this->submission->submit();

        $this->updater->award_attendance_trophy($submission_id);
        $awards = array(Data\Trophy::ATTENDANCE);

        if ($this->updater->is_within_bmi_range($this->submission->get_weight()))
        {
            $this->updater->award_bmi_trophy($submission_id);
            $awards[] = Data\Trophy::BMI;
        }

        list($previous_update_date, $previous_update_weight) = $this->updater->get_previous_update_date_and_weight();

        if ($this->updater->has_made_progress($previous_update_weight, $this->submission->get_weight()))
        {
            $this->updater->award_progress_trophy($submission_id);
            $awards[] = Data\Trophy::PROGRESS;
        }

        if ($this->submission->has_food())
        {
            $this->updater->award_food_trophy($submission_id);
            $awards[] = Data\Trophy::FOOD;
        }

        if ($previous_update_date === date('Ymd', strtotime('yesterday')))
        {
            $this->updater->award_combo_trophy($submission_id);
            $awards[] = Data\TROPHY::COMBO;
        }

        if ($this->updater->is_on_target($this->submission->get_weight()))
        {
            $this->updater->award_lead_trophy($submission_id);
            $awards[] = Data\TROPHY::LEAD;
        }

        return $awards;
    }
}
