<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition;
use Welgam\Core\Usecase\Competition\Edit\Interactor;
use Welgam\Core\Usecase\Competition\Edit\Editor;
use Welgam\Core\Usecase\Competition\Edit\Submission;

class Edit
{
    private $data;
    private $repositories;
    private $tools;

    public function __construct(array $data, array $repositories, array $tools)
    {
        $this->data = $data;
        $this->repositories = $repositories;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->get_editor(),
            $this->get_submission()
        );
    }

    private function get_editor()
    {
        return new Editor(
            $this->data['racer'],
            $this->repositories['competition_edit']
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['racer']->competition,
            $this->repositories['competition_edit'],
            $this->tools['validator']
        );
    }
}
