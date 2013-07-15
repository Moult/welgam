<?php

namespace spec\Welgam\Core\Usecase\Racer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Racer\Add\Repository $racer_add
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $competition, $racer_add, $emailer, $formatter, $validator)
    {
        $racer->competition = $competition;

        $data = array(
            'racer' => $racer,
            'racer_registrant' => $racer
        );

        $repositories = array(
            'racer_add' => $racer_add
        );

        $tools = array(
            'emailer' => $emailer,
            'formatter' => $formatter,
            'validator' => $validator
        );

        $this->beConstructedWith($data, $repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Interactor');
    }
}
