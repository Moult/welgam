<?php

namespace spec\Welgam\Core\Usecase\Racer\Remind;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GuestSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Remind\Repository $repository
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $repository, $emailer, $formatter, $validator)
    {
        $racer->email = 'email';
        $this->beConstructedWith($racer, $repository, $emailer, $formatter, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Remind\Guest');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_can_validate_its_email_address($validator)
    {
        $validator->setup(array(
            'email' => 'email'
        ))->shouldBeCalled();
        $validator->rule('email', 'not_empty')->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->rule('email', 'email_domain')->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('email'));
        $this->shouldThrow('Welgam\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_does_not_authorise_non_participants($repository)
    {
        $repository->does_racer_with_email_exist('email')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise_participant();
    }

    function it_can_notify_the_racer_about_all_their_competition_urls($repository, $emailer, $formatter)
    {
        $repository->get_access_details_of_competitions('email')->shouldBeCalled()->willReturn(array(array('competition_name' => 'competition_name', 'competition_id' => 'competition_id', 'racer_id', 'racer_password' => 'racer_password')));
        $formatter->setup(array(
            'email' => 'email',
            'competitions' => array(array('competition_name' => 'competition_name', 'competition_id' => 'competition_id', 'racer_id', 'racer_password' => 'racer_password'))
        ))->shouldBeCalled();
        $formatter->format('Email_Racer_Remind_Subject')->shouldBeCalled()->willReturn('email_subject');
        $formatter->format('Email_Racer_Remind_Body')->shouldBeCalled()->willReturn('email_body');
        $emailer->set_to(array('email' => 'WeightRace Participant'))->shouldBeCalled();
        $emailer->set_subject('email_subject')->shouldBeCalled();
        $emailer->set_body('email_body')->shouldBeCalled();
        $emailer->send()->shouldBeCalled();
        $this->notify_about_competition_urls();
    }
}
