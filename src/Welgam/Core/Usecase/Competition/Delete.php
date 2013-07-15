<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition;
use Welgam\Core\Usecase\Competition\Delete\Interactor;
use Welgam\Core\Usecase\Competition\Delete\Deleter;
use Welgam\Core\Usecase\Competition\Delete\Submission;

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
            $this->get_deleter(),
            $this->get_submission()
        );
    }

    private function get_deleter()
    {
        return new Deleter(
            $this->data['racer'],
            $this->repositories['competition_delete']
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['racer']->competition,
            $this->repositories['competition_delete']
        );
    }
}
