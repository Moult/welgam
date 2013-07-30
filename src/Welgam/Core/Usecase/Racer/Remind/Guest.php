<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Remind;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Guest extends Data\Racer
{
    public $email;
    private $repository;
    private $emailer;
    private $formatter;
    private $validator;

    public function __construct(Data\Racer $racer, Repository $repository, Tool\Emailer $emailer, Tool\Formatter $formatter, Tool\Validator $validator)
    {
        $this->email = $racer->email;
        $this->repository = $repository;
        $this->emailer = $emailer;
        $this->formatter = $formatter;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'email' => $this->email
        ));
        $this->validator->rule('email', 'not_empty');
        $this->validator->rule('email', 'email');
        $this->validator->rule('email', 'email_domain');
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function authorise_participant()
    {
        if ( ! $this->repository->does_racer_with_email_exist($this->email))
            throw new Exception\Authorisation('You are not participating in any races');
    }

    public function notify_about_competition_urls()
    {
        $this->formatter->setup(array(
            'email' => $this->email,
            'competitions' => $this->repository->get_access_details_of_competitions($this->email)
        ));
        $this->emailer->set_to(array($this->email => 'WeightRace Participant'));
        $this->emailer->set_subject($this->formatter->format('Email_Racer_Remind_Subject'));
        $this->emailer->set_body($this->formatter->format('Email_Racer_Remind_Body'));
        $this->emailer->send();
    }
}
