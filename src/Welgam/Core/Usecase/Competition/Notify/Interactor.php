<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Notify;
use Welgam\Core\Tool;

class Interactor
{
    private $repository;
    private $emailer;
    private $formatter;

    public function __construct(Repository $repository, Tool\Emailer $emailer, Tool\Formatter $formatter)
    {
        $this->repository = $repository;
        $this->emailer = $emailer;
        $this->formatter = $formatter;
    }

    public function interact()
    {
        $competitions = $this->repository->get_competition_ids_and_names();
        foreach ($competitions as $competition_details)
        {
            list($competition_id, $competition_name) = $competition_details;
            $racers = $this->repository->get_racers_ids_passwords_names_emails($competition_id);
            foreach ($racers as $racer_details)
            {
                list($racer_id, $racer_password, $racer_name, $racer_email) = $racer_details;
                $this->formatter->setup(array(
                    'competition_id' => $competition_id,
                    'competition_name' => $competition_name,
                    'racer_id' => $racer_id,
                    'racer_password' => $racer_password,
                    'racer_name' => $racer_name
                ));
                $this->emailer->set_to($racer_email);
                $this->emailer->set_subject($this->formatter->format('Email_Competition_Notify_Subject'));
                $this->emailer->set_body($this->formatter->format('Email_Competition_Notify_Body'));
                $this->emailer->send();
            }
        }


    }
}
