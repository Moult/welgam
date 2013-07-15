<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;

class Interactor
{
    private $updater;
    private $submission;

    public function __construct(Updater $updater, Submission $submission)
    {
        $this->updater = $updater;
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->updater->authorise();
        if ( ! $this->updater->has_updated_today())
        {
            $this->submission->validate();
            $this->submission->submit();
        }
    }
}
