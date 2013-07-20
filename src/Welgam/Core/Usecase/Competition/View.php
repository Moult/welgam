<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition;
use Welgam\Core\Usecase\Competition\View\Interactor;
use Welgam\Core\Usecase\Competition\View\Competition;
use Welgam\Core\Usecase\Competition\View\Participant;

class View
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
            $this->get_competition(),
            $this->get_participant()
        );
    }

    private function get_competition()
    {
        return new Competition(
            $this->data['racer']->competition,
            $this->repositories['competition_view']
        );
    }

    private function get_participant()
    {
        return new Participant(
            $this->data['racer'],
            $this->repositories['competition_view']
        );
    }
}
