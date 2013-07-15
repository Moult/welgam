<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Add;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Submission
{
    public $id;
    public $name;
    public $private;
    public $start_date;
    public $end_date;
    private $repository;
    private $validator;

    public function __construct(Data\Competition $competition, Repository $repository, Tool\Validator $validator)
    {
        $this->name = $competition->name;
        $this->private = $competition->private;
        $this->start_date = $competition->start_date;
        $this->end_date = $competition->end_date;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ));
        $this->validator->rule('name', 'not_empty');
        $this->validator->callback(
            'start_date',
            array($this, 'is_not_in_the_past'),
            array('start_date')
        );
        $this->validator->callback(
            'end_date',
            array($this, 'is_after_start_date'),
            array('end_date', 'start_date')
        );

        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function is_not_in_the_past($start_date)
    {
        if ($start_date >= date('Ymd', strtotime('today')))
            return TRUE;
        else
            return FALSE;
    }

    public function is_after_start_date($end_date, $start_date)
    {
        if ($end_date > $start_date)
            return TRUE;
        else
            return FALSE;
    }

    public function add()
    {
        $this->id = $this->repository->add_competition(
            $this->name,
            $this->private,
            $this->start_date,
            $this->end_date
        );
    }

    public function get_id()
    {
        return $this->id;
    }
}
