<?php

namespace spec\Welgam\Core\Usecase\Competition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Delete\Repository $competition_delete
     */
    function let($racer, $competition, $competition_delete)
    {
        $racer->competition = $competition;
        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'competition_delete' => $competition_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Delete');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Competition\Delete\Interactor');
    }
}
