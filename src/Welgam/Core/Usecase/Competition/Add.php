<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition;
use Welgam\Core\Usecase\Competition\Add\Interactor;
use Welgam\Core\Usecase\Competition\Add\Submission;

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

    public function get_submission()
    {
        return new Submission(
            $this->data['competition'],
            $this->repositories['competition_add'],
            $this->tools['validator']
        );
    }
}
