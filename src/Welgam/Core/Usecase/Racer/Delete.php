<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer;
use Welgam\Core\Usecase\Racer\Delete\Interactor;
use Welgam\Core\Usecase\Racer\Delete\Submission;

class Delete
{
    private $data;
    private $repositories;

    public function __construct(array $data, array $repositories)
    {
        $this->data = $data;
        $this->repositories = $repositories;
    }

    public function fetch()
    {
        return new Interactor(
            $this->get_submission()
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['racer'],
            $this->repositories['racer_delete']
        );
    }
}
