<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Delete;
use Welgam\Core\Data;

class Submission extends Data\Competition
{
    public $id;
    private $repository;

    public function __construct(Data\Competition $competition, Repository $repository)
    {
        $this->id = $competition->id;
        $this->repository = $repository;
    }

    public function delete()
    {
        $this->repository->delete_competition($this->id);
    }
}
