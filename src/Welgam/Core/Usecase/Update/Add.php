<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update;
Use Welgam\Core\Usecase\Update\Add\Interactor;
Use Welgam\Core\Usecase\Update\Add\Competition;
Use Welgam\Core\Usecase\Update\Add\Updater;
Use Welgam\Core\Usecase\Update\Add\Submission;

class Add
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
            $this->get_competition(),
            $this->get_updater(),
            $this->get_submission()
        );
    }

    private function get_competition()
    {
        return new Competition(
            $this->data['update']->racer,
            $this->repositories['update_add']
        );
    }

    private function get_updater()
    {
        return new Updater(
            $this->data['update']->racer,
            $this->repositories['update_add']
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['update'],
            $this->repositories['update_add'],
            $this->tools['validator']
        );
    }
}
