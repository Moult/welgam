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
    private $repository;

    public function __construct(Data\Racer $racer, Repository $repository)
    {
        $this->id = $racer->id;
        $this->password = $racer->password;
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
    }

    public function is_within_bmi_range($weight)
    {
    }

    public function award_bmi_trophy()
    {
    }

    public function get_previous_update_date_and_weight()
    {
    }

    public function has_made_progress($past_weight)
    {
    }

    public function award_progress_trophy()
    {
    }

    public function award_food_trophy()
    {
    }

    public function award_combo_trophy()
    {
    }
}
