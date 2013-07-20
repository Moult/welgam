<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition;
use Welgam\Core\Usecase\Competition\Notify\Interactor;

class Notify
{
    private $repositories;
    private $tools;

    public function __construct(array $repositories, array $tools)
    {
        $this->repositories = $repositories;
        $this->tools = $tools;
    }

    public function fetch()
    {
        return new Interactor(
            $this->repositories['competition_notify'],
            $this->tools['emailer'],
            $this->tools['formatter']
        );
    }
}
