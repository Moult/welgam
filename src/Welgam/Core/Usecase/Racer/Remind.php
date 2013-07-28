<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer;
use Welgam\Core\Usecase\Racer\Remind\Interactor;
use Welgam\Core\Usecase\Racer\Remind\Guest;

class Remind
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
            $this->get_guest()
        );
    }

    private function get_guest()
    {
        return new Guest(
            $this->data['racer'],
            $this->repositories['racer_remind'],
            $this->tools['emailer'],
            $this->tools['formatter'],
            $this->tools['validator']
        );
    }
}
