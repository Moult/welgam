<?php

namespace spec\Welgam\Core\Usecase\Competition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ViewSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\View\Repository $competition_view
     */
    function let($racer, $competition, $competition_view)
    {
        $racer->competition = $competition;

        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'competition_view' => $competition_view
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\View');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Competition\View\Interactor');
    }
}
