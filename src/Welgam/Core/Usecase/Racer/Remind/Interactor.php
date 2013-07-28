<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Remind;

class Interactor
{
    private $guest;

    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    public function interact()
    {
        $this->guest->validate();
        $this->guest->authorise_participant();
        $this->guest->notify_about_competition_urls();
    }
}
