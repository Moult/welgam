<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Updater extends Data\Racer
{
    public $id;
    public $password;
    public $weight;
    public $height;
    public $goal_weight;
    private $repository;

    public function __construct(Data\Racer $racer, Repository $repository)
    {
        $this->id = $racer->id;
        $this->password = $racer->password;
        list($this->weight, $this->height, $this->goal_weight) = $repository->get_weight_and_height_and_goal_weight($this->id);
        $this->repository = $repository;
    }

    public function authorise()
    {
        if ( ! $this->repository->does_racer_exist($this->id, $this->password))
            throw new Exception\Authorisation('You cannot add an update to this racer');
    }

    public function has_updated_today()
    {
        return $this->repository->does_update_exist(date('Ymd', strtotime('today')), $this->id);
    }

    public function award_attendance_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::ATTENDANCE, $submission_id);
    }

    public function is_within_bmi_range($weight)
    {
        $height_in_m = $this->height / 100;
        $bmi = $weight / ($height_in_m * $height_in_m);
        if ($bmi > 18.5 AND $bmi <= 24.9)
            return TRUE;
        else
            return FALSE;
    }

    public function award_bmi_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::BMI, $submission_id);
    }

    public function get_previous_update_date_and_weight()
    {
        return $this->repository->get_previous_update_date_and_weight($this->id);
    }

    public function has_made_progress($past_weight, $todays_weight)
    {
        if (($this->goal_weight < $this->weight AND $todays_weight < $past_weight)
            OR ($this->goal_weight > $this->weight AND $todays_weight > $past_weight))
            return TRUE;
        else
            return FALSE;
    }

    public function award_progress_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::PROGRESS, $submission_id);
    }

    public function award_food_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::FOOD, $submission_id);
    }

    public function award_combo_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::COMBO, $submission_id);
    }

    public function is_on_target($todays_weight)
    {
        list($start_date_yyyymmdd, $end_date_yyyymmdd) = $this->repository->get_competition_start_and_end_date($this->id);

        $start_date = new \DateTime(substr($start_date_yyyymmdd, 0, 4).'-'.substr($start_date_yyyymmdd, 4, 2).'-'.substr($start_date_yyyymmdd, 6));
        $end_date = new \DateTime(substr($end_date_yyyymmdd, 0, 4).'-'.substr($end_date_yyyymmdd, 4, 2).'-'.substr($end_date_yyyymmdd, 6));
        $today = new \DateTime(date('Y-m-d', strtotime('today')));
        $total_duration = $end_date->diff($start_date)->days;
        $elapsed_duration = $today->diff($start_date)->days;

        $target_weight = (($elapsed_duration / $total_duration) * ($this->goal_weight - $this->weight)) + $this->weight;

        if ($this->goal_weight < $this->weight)
            return $todays_weight <= $target_weight;
        else
            return $todays_weight >= $target_weight;
    }

    public function award_lead_trophy($submission_id)
    {
        $this->repository->add_award(Data\Trophy::LEAD, $submission_id);
    }
}
