<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Edit;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Submission extends Data\Racer
{
    public $id;
    public $password;
    public $email;
    public $goal_weight;
    private $repository;
    private $validator;

    public function __construct(Data\Racer $racer, Repository $repository, Tool\Validator $validator)
    {
        $this->id = $racer->id;
        $this->password = $racer->password;
        $this->email = $racer->email;
        $this->goal_weight = $racer->goal_weight;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function authorise()
    {
        if ( ! $this->repository->does_racer_exist($this->id, $this->password))
            throw new Exception\Authorisation('You cannot edit this racer.');
    }

    public function validate()
    {
        $this->validator->setup(array(
            'email' => $this->email,
            'goal_weight' => $this->goal_weight
        ));
        $this->validator->rule('email', 'email');
        $this->validator->rule('email', 'email_domain');
        $this->validator->callback(
            'goal_weight',
            array($this, 'is_reasonable_number'),
            array('goal_weight')
        );
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_reasonable_number($number)
    {
        return $number > 0 AND $number <= 500;
    }

    public function update()
    {
        $this->repository->update_racer(
            $this->id,
            $this->email,
            $this->goal_weight
        );
    }
}
