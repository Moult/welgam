<?php

namespace spec\Welgam\Core\Usecase\Racer\Remind;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Usecase\Racer\Remind\Guest $guest
     */
    function let($guest)
    {
        $this->beConstructedWith($guest);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Racer\Remind\Interactor');
    }

    function it_carries_out_the_interaction_chain($guest)
    {
        $guest->validate()->shouldBeCalled();
        $guest->authorise_participant()->shouldBeCalled();
        $guest->notify_about_competition_urls()->shouldBeCalled();
        $this->interact();
    }
}
