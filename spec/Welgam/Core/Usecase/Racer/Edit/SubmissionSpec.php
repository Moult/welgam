<?php

namespace spec\Welgam\Core\Usecase\Racer\Edit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Racer\Edit\Repository $repository
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($racer, $repository, $validator)
    {
        $racer->id = 'id';
        $racer->password = 'password';
        $racer->email = 'email';
        $racer->goal_weight = 'goal_weight';
        $this->beConstructedWith($racer, $repository, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Edit\Submission');
    }

    function it_is_a_racer()
    {
        $this->shouldHaveType('Welgam\Core\Data\Racer');
    }

    function it_can_authorise($repository)
    {
        $repository->does_racer_exist('id', 'password')->shouldBeCalled()->willReturn(FALSE);
        $this->shouldThrow('Welgam\Core\Exception\Authorisation')
            ->duringAuthorise();
    }

    function it_validates($validator)
    {
        $validator->setup(array(
            'email' => 'email',
            'goal_weight' => 'goal_weight'
        ))->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->rule('email', 'email_domain')->shouldBeCalled();
        $validator->callback('goal_weight', array($this, 'is_reasonable_number'), array('goal_weight'))->shouldBeCalled();
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

    function it_can_update($repository)
    {
        $repository->update_racer('id', 'email', 'goal_weight')->shouldBeCalled();
        $this->update();
    }
}
