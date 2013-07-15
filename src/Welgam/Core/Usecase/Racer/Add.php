<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer;
use Welgam\Core\Usecase\Racer\Add\Interactor;
use Welgam\Core\Usecase\Racer\Add\Submission;

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
            $this->get_submission()
        );
    }

    private function get_submission()
    {
        return new Submission(
            $this->data['racer'],
            $this->repositories['racer_add'],
            $this->tools['emailer'],
            $this->tools['formatter'],
            $this->tools['validator']
        );
    }
}
