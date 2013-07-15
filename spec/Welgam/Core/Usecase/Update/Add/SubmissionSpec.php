<?php

namespace spec\Welgam\Core\Usecase\Update\Add;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Update $update
     * @param Welgam\Core\Data\Racer $racer
     * @param Welgam\Core\Usecase\Update\Add\Repository $repository
     * @param Welgam\Core\Tool\Validator $validator
     */
    function let($update, $racer, $repository, $validator)
    {
        $racer->id = 'racer_id';
        $update->weight = 'weight';
        $update->food = 'food';
        $update->racer = $racer;
        $this->beConstructedWith($update, $repository, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Add\Submission');
    }

    function it_is_an_update()
    {
        $this->shouldHaveType('Welgam\Core\Data\Update');
    }

    function it_validates_the_submission($validator)
    {
        $validator->setup(array(
            'weight' => 'weight'
        ))->shouldBeCalled();
        $validator->rule('weight', 'not_empty')->shouldBeCalled();
        $validator->callback('weight', array($this, 'is_reasonable_number'), array('weight'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array());
        $this->shouldThrow('Welgam\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_submits($repository)
    {
        $today = date('Ymd', strtotime('today'));
        $repository->add_update('weight', 'food', $today, 'racer_id')->shouldBeCalled();
        $this->submit();
    }
}
