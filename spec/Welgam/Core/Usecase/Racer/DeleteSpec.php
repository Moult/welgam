<?php

namespace spec\Welgam\Core\Usecase\Racer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Delete\Repository $racer_delete
     */
    function let($racer, $racer_delete)
    {
        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'racer_delete' => $racer_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Delete');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Racer\Delete\Interactor');
    }
}
