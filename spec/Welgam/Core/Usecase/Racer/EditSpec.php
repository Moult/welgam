<?php

namespace spec\Welgam\Core\Usecase\Racer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EditSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Edit\Repository $racer_edit
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $racer_edit, $validator)
    {
        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'racer_edit' => $racer_edit
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Edit');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Racer\Edit\Interactor');
    }
}
