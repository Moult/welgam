<?php

namespace spec\Welgam\Core\Usecase\Competition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotifySpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\Notify\Repository $competition_notify
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     */
    function let($competition_notify, $emailer, $formatter)
    {
        $repositories = array(
            'competition_notify' => $competition_notify
        );

        $tools = array(
            'emailer' => $emailer,
            'formatter' => $formatter
        );

        $this->beConstructedWith($repositories, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Notify');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Competition\Notify\Interactor');
    }
}
