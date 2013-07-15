<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Delete;

class Interactor
{
    private $deleter;
    private $submission;

    public function __construct(Deleter $deleter, Submission $submission)
    {
        $this->deleter = $deleter;
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->deleter->authorise();
        $this->submission->delete();
    }
}
