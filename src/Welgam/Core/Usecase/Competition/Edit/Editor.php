<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Edit;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Editor extends Data\Racer
{
    public $id;
    public $password;
    public $competition;
    private $repository;

    public function __construct(Data\Racer $racer, Repository $repository)
    {
        $this->id = $racer->id;
        $this->password = $racer->password;
        $this->competition = $racer->competition;
        $this->repository = $repository;
    }

    public function authorise_participant()
    {
        if ( ! $this->repository->is_racer_part_of_competition($this->id, $this->password, $this->competition->id))
            throw new Exception\Authorisation('You are not allowed to edit this competition');
    }
}
