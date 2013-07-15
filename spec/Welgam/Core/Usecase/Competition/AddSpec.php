<?php

namespace spec\Welgam\Core\Usecase\Competition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Competition\Add\Repository $competition_add
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($competition, $competition_add, $validator)
    {
        $data = array(
            'competition' => $competition
        );

        $repositories = array(
            'competition_add' => $competition_add
        );

        $tools = array(
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Add');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Competition\Add\Interactor');
    }
}
