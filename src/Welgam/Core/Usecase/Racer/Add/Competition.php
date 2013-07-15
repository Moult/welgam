<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;
use Welgam\Core\Data;

class Competition extends Data\Competition
{
    public $id;
    private $repository;

    public function __construct(Data\Competition $competition, Repository $repository)
    {
        $this->id = $competition->id;
        $this->repository = $repository;
    }

    public function has_racers()
    {
        return $this->repository->does_competition_have_racers($this->id);
    }
}
