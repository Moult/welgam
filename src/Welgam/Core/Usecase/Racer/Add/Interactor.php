<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;

class Interactor
{
    private $competition;
    private $registrant;
    private $submission;

    public function __construct(Competition $competition, Registrant $registrant, Submission $submission)
    {
        $this->competition = $competition;
        $this->registrant = $registrant;
        $this->submission = $submission;
    }

    public function interact()
    {
        if ($this->competition->has_racers())
        {
            $this->registrant->authorise();
        }
        $this->submission->validate();
        $this->submission->generate_password();
        $this->submission->add();
        $this->submission->notify();
        return array($this->submission->get_id(), $this->submission->get_password());
    }
}
