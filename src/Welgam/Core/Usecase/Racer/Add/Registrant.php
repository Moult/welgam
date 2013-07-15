<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Registrant extends Data\Racer
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
        if ( ! $this->repository->does_racer_participate_in_competition($this->id, $this->password, $this->competition->id))
            throw new Exception\Authorisation('Only existing racers can add new racers to a competition.');
    }
}
