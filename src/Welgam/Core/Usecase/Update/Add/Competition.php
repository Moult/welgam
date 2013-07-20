<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;
use Welgam\Core\Data;

class Competition extends Data\Competition
{
    public $id;
    public $start_date;
    public $end_date;
    private $repository;

    public function __construct(Data\Racer $racer, Repository $repository)
    {
        list($this->id,
            $this->start_date,
            $this->end_date) = $repository->get_competition_id_and_start_and_end_dates($racer->id);
        $this->repository = $repository;
    }

    public function is_running()
    {
        $today = date('Ymd', strtotime('today'));
        if ($today >= $this->start_date AND $today < $this->end_date)
            return TRUE;
        else
            return FALSE;
    }
}
