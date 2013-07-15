<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Submission extends Data\Racer
{
    public $name;
    public $email;
    public $height;
    public $weight;
    public $male;
    public $race;
    public $goal_weight;
    public $competition;
    private $repository;
    private $emailer;
    private $formatter;
    private $validator;

    public function __construct(Data\Racer $racer, Repository $repository, Tool\Emailer $emailer, Tool\Formatter $formatter, Tool\Validator $validator)
    {
        $this->name = $racer->name;
        $this->email = $racer->email;
        $this->height = $racer->height;
        $this->weight = $racer->weight;
        $this->male = $racer->male;
        $this->race = $racer->race;
        $this->goal_weight = $racer->goal_weight;
        $this->competition = $racer->competition;
        $this->repository = $repository;
        $this->emailer = $emailer;
        $this->formatter = $formatter;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'email' => $this->email,
            'height' => $this->height,
            'weight' => $this->weight,
            'race' => $this->race,
            'goal_weight' => $this->goal_weight,
            'competition_id' => $this->competition->id
        ));
        $this->validator->rule('name', 'not_empty');
        $this->validator->rule('email', 'email');
        $this->validator->rule('email', 'email_domain');
        $this->validator->callback(
            'height',
            array($this, 'is_reasonable_number'),
            array('height')
        );
        $this->validator->callback(
            'weight',
            array($this, 'is_reasonable_number'),
            array('weight')
        );
        $this->validator->callback(
            'race',
            array($this, 'is_valid_race'),
            array('race')
        );
        $this->validator->callback(
            'goal_weight',
            array($this, 'is_reasonable_number'),
            array('goal_weight')
        );
        $this->validator->callback(
            'competition_id',
            array($this, 'is_existing_competition'),
            array('competition_id')
        );
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_reasonable_number($number)
    {
        return $number > 0 AND $number <= 500;
    }

    public function is_valid_race($race)
    {
        $data_race = new \ReflectionClass('Welgam\Core\Data\Race');
        $races = $data_race->getConstants();
        if (in_array($race, $races))
            return TRUE;
        else
            return FALSE;
    }

    public function is_existing_competition($competition_id)
    {
        return $this->repository->does_competition_exist($competition_id);
    }

    public function generate_password()
    {
        $this->password = md5(microtime().rand(1000,9999));
    }

    public function add()
    {
        $this->id = $this->repository->add_racer(
            $this->name,
            $this->password,
            $this->email,
            $this->height,
            $this->weight,
            $this->male,
            $this->race,
            $this->goal_weight,
            $this->competition->id
        );
    }

    public function notify()
    {
        $competition_name = $this->repository->get_competition_name($this->competition->id);
        $this->formatter->setup(array(
            'racer_id' => $this->id,
            'racer_name' => $this->name,
            'racer_password' => $this->password,
            'competition_id' => $this->competition->id,
            'competition_name' => $competition_name
        ));

        $this->emailer->set_to($this->email);
        $this->emailer->set_subject($this->formatter->format('email_racer_add_subject'));
        $this->emailer->set_body($this->formatter->format('email_racer_add_body'));
        $this->emailer->send();
    }
}
