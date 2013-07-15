<?php

namespace spec\Welgam\Core\Usecase\Competition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EditSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Edit\Repository $competition_edit
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $competition, $competition_edit, $validator)
    {
        $racer->competition = $competition;

        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'competition_edit' => $competition_edit
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Edit');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Competition\Edit\Interactor');
    }
}
