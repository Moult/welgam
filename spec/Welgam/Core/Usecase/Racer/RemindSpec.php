<?php

namespace spec\Welgam\Core\Usecase\Racer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemindSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Remind\Repository $racer_remind
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $racer_remind, $emailer, $formatter, $validator)
    {
        $data = array(
            'racer' => $racer
        );

        $repositories = array(
            'racer_remind' => $racer_remind
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
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Remind');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Racer\Remind\Interactor');
    }
}
