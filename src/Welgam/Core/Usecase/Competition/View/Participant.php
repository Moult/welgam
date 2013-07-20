<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\View;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Participant extends Data\Racer
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

    public function authorise()
    {
        if ( ! $this->repository->does_competition_have_racer($this->competition->id, $this->id, $this->password))
            throw new Exception\Authorisation('You cannot view this competition');
    }
}
