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

    public function award_attendance_trophy()
    {
        $this->repository->add_award(Data\Trophy::ATTENDANCE, $this->id);
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

    public function award_bmi_trophy()
    {
        $this->repository->add_award(Data\Trophy::BMI, $this->id);
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

    public function award_progress_trophy()
    {
        $this->repository->add_award(Data\Trophy::PROGRESS, $this->id);
    }

    public function award_food_trophy()
    {
        $this->repository->add_award(Data\Trophy::FOOD, $this->id);
    }

    public function award_combo_trophy()
    {
        $this->repository->add_award(Data\Trophy::COMBO, $this->id);
    }
}
