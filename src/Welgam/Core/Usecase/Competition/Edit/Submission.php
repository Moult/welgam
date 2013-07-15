<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Edit;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Submission extends Data\Competition
{
    public $id;
    public $name;
    public $end_date;
    private $repository;
    private $validator;

    public function __construct(Data\Competition $competition, Repository $repository, Tool\Validator $validator)
    {
        $this->id = $competition->id;
        $this->name = $competition->name;
        $this->end_date = $competition->end_date;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'start_date' => $this->repository->get_competition_start_date($this->id),
            'end_date' => $this->end_date
        ));
        $this->validator->rule('name' ,'not_empty');
        $this->validator->callback(
            'end_date',
            array($this, 'is_after_start_date'),
            array('end_date', 'start_date')
        );
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_after_start_date($end_date, $start_date)
    {
        if ($end_date > $start_date)
            return TRUE;
        else
            return FALSE;
    }

    public function update()
    {
        $this->repository->update_competition(
            $this->id,
            $this->name,
            $this->end_date
        );
    }
}
