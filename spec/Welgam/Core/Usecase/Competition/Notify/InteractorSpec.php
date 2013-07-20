<?php

namespace spec\Welgam\Core\Usecase\Competition\Notify;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Competition\Notify\Repository $repository
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     */
    function let($repository, $emailer, $formatter)
    {
        $this->beConstructedWith($repository, $emailer, $formatter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Competition\Notify\Interactor');
    }

    function it_should_run_the_interaction_chain($repository, $emailer, $formatter)
    {
        $repository->get_competition_ids_and_names()->shouldBeCalled()->willReturn(array(
            array('competition_id', 'competition_name')
        ));

        $repository->get_racers_ids_passwords_names_emails('competition_id')->shouldBeCalled()->willReturn(array(
            array('racer_id', 'racer_password', 'racer_name', 'racer_email')
        ));

        $formatter->setup(array(
            'competition_id' => 'competition_id',
            'competition_name' => 'competition_name',
            'racer_id' => 'racer_id',
            'racer_password' => 'racer_password',
            'racer_name' => 'racer_name',
        ))->shouldBeCalled();
        $formatter->format('Email_Competition_Notify_Subject')->shouldBeCalled()->willReturn('email_subject');
        $formatter->format('Email_Competition_Notify_Body')->shouldBeCalled()->willReturn('email_body');
        $emailer->set_to('racer_email')->shouldBeCalled();
        $emailer->set_subject('email_subject')->shouldBeCalled();
        $emailer->set_body('email_body')->shouldBeCalled();
        $emailer->send()->shouldBeCalled();
        $this->interact();
    }
}
