<?php

namespace spec\Welgam\Core\Usecase\Update;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteSpec extends ObjectBehavior
{
    /**
     * @param Welgam\Core\Data\Update $update
     * @param Welgam\Core\Usecase\Update\Delete\Repository $update_delete
     */
    function let($update, $update_delete)
    {
        $data = array(
            'update' => $update
        );

        $repositories = array(
            'update_delete' => $update_delete
        );

        $this->beConstructedWith($data, $repositories);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Welgam\Core\Usecase\Update\Delete');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Welgam\Core\Usecase\Update\Delete\Interactor');
    }
}
