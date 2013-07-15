<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Delete;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Submission extends Data\Racer
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
            throw new Exception\Authorisation('You cannot delete this racer.');
    }

    public function delete()
    {
        $this->repository->delete_racer($this->id);
    }
}
