<?php

namespace spec\Welgam\Core\Usecase\Racer\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Data\Competition $competition
     * @param Welgam\Core\Usecase\Racer\Add\Repository $repository
     * @param Welgam\Core\Tool\Emailer $emailer
     * @param Welgam\Core\Tool\Formatter $formatter
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $competition, $repository, $emailer, $formatter, $validator)
    {
        $racer->name = 'name';
        $racer->password = 'password';
        $racer->email = 'email';
        $racer->height = 'height';
        $racer->weight = 'weight';
        $racer->male = 'male';
        $racer->race = 'race';
        $racer->goal_weight = 'goal_weight';
        $competition->id = 'competition_id';
        $racer->competition = $competition;
        $this->beConstructedWith($racer, $repository, $emailer, $formatter, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Add\Submission');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_can_validate($validator)
    {
        $validator->setup(array(
            'name' => 'name',
            'email' => 'email',
            'height' => 'height',
            'weight' => 'weight',
            'race' => 'race',
            'goal_weight' => 'goal_weight',
            'competition_id' => 'competition_id'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->rule('email', 'email_domain')->shouldBeCalled();
        $validator->callback('height', array($this, 'is_reasonable_number'), array('height'))->shouldBeCalled();
        $validator->callback('weight', array($this, 'is_reasonable_number'), array('weight'))->shouldBeCalled();
        $validator->callback('race', array($this, 'is_valid_race'), array('race'))->shouldBeCalled();
        $validator->callback('goal_weight', array($this, 'is_reasonable_number'), array('goal_weight'))->shouldBeCalled();
        $validator->callback('competition_id', array($this, 'is_existing_competition'), array('competition_id'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array());
        $this->shouldThrow('Welgam\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_can_check_for_resonable_numbers()
    {
        $this->is_reasonable_number(1)->shouldReturn(TRUE);
        $this->is_reasonable_number(0)->shouldReturn(FALSE);
        $this->is_reasonable_number(500)->shouldReturn(TRUE);
        $this->is_reasonable_number(501)->shouldReturn(FALSE);
    }

    function it_can_check_for_valid_races()
    {
        $this->is_valid_race(0)->shouldReturn(TRUE);
        $this->is_valid_race(1)->shouldReturn(TRUE);
        $this->is_valid_race(2)->shouldReturn(TRUE);
        $this->is_valid_race(3)->shouldReturn(TRUE);
        $this->is_valid_race(4)->shouldReturn(FALSE);
    }

    function it_will_check_for_existing_competitions($repository)
    {
        $repository->does_competition_exist('competition_id')->shouldBeCalled()->willReturn(TRUE);
        $this->is_existing_competition('competition_id')->shouldReturn(TRUE);
    }

    function it_can_generate_a_password()
    {
        $this->password->shouldBe(NULL);
        $this->generate_password();
        $this->password->shouldNotBe(NULL);
        $previous_password = $this->password;
        $this->generate_password();
        $this->password->shouldNotBe($previous_password);
    }

    function it_can_add_the_racer($repository)
    {
        $repository->add_racer('name', NULL, 'email', 'height', 'weight', 'male', 'race', 'goal_weight', 'competition_id')->shouldBeCalled()->willReturn('racer_id');
        $this->add();
        $this->id->shouldBe('racer_id');
    }

    function it_can_notify($repository, $emailer, $formatter)
    {
        $repository->add_racer('name', NULL, 'email', 'height', 'weight', 'male', 'race', 'goal_weight', 'competition_id')->shouldBeCalled()->willReturn('id');

        $repository->get_competition_name('competition_id')->shouldBeCalled()->willReturn('competition_name');
        $formatter->setup(array(
            'racer_id' => 'id',
            'racer_name' => 'name',
            'racer_password' => NULL,
            'competition_id' => 'competition_id',
            'competition_name' => 'competition_name'
        ))->shouldBeCalled();
        $formatter->format('email_racer_add_subject')->shouldBeCalled()->willReturn('email_subject');
        $formatter->format('email_racer_add_body')->shouldBeCalled()->willReturn('email_body');
        $emailer->set_to('email')->shouldBeCalled();
        $emailer->set_subject('email_subject')->shouldBeCalled();
        $emailer->set_body('email_body')->shouldBeCalled();
        $emailer->send()->shouldBeCalled();

        $this->add();
        $this->notify();
    }
}
