<?php

namespace spec\Welgam\Core\Usecase\Update;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Update $update
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Update\Add\Repository $update_add
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($update, $racer, $update_add, $validator)
    {
        $update->racer = $racer;

        $data = array(
            'update' => $update
        );

        $repositories = array(
            'update_add' => $update_add
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Update\Add\Interactor');
    }
}
