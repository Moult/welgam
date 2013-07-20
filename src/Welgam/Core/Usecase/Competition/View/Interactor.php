<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\View;

class Interactor
{
    private $competition;
    private $participant;

    public function __construct(Competition $competition, Participant $participant)
    {
        $this->competition = $competition;
        $this->participant = $participant;
    }

    public function interact()
    {
        if ($this->competition->has_racers())
        {
            $this->participant->authorise();
        }
        return $this->competition->get_details();
    }
}
