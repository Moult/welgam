<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Delete;
use Welgam\Core\Data;
use Welgam\Core\Exception;

class Submission extends Data\Update
{
    public $id;
    public $racer;
    private $repository;

    public function __construct(Data\Update $update, Repository $repository)
    {
        $this->id = $update->id;
        $this->racer = $update->racer;
        $this->repository = $repository;
    }

    public function authorise()
    {
        list($owner_id, $owner_password) = $this->repository->get_update_owner_id_and_password($this->id);

        if ($owner_id !== $this->racer->id OR $owner_password !== $this->racer->password)
            throw new Exception\Authorisation('You cannot delete this update');
    }

    public function delete()
    {
        $this->repository->delete_update($this->id);
    }
}
