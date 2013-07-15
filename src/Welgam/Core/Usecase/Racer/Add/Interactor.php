<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;

class Interactor
{
    private $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->submission->validate();
        $this->submission->generate_password();
        $this->submission->add();
        $this->submission->notify();
    }
}
