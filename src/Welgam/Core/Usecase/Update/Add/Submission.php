<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;
use Welgam\Core\Data;
use Welgam\Core\Tool;
use Welgam\Core\Exception;

class Submission extends Data\Update
{
    public $weight;
    public $food;
    public $racer;
    private $repository;
    private $validator;

    public function __construct(Data\Update $update, Repository $repository, Tool\Validator $validator)
    {
        $this->weight = $update->weight;
        $this->food = $update->food;
        $this->racer = $update->racer;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->setup(array(
            'weight' => $this->weight
        ));
        $this->validator->rule('weight', 'not_empty');
        $this->validator->callback(
            'weight',
            array($this, 'is_reasonable_number'),
            array('weight')
        );
        if ( ! $this->validator->check())
            throw new Exception\Validation($this->validator->errors());
    }

    public function submit()
    {
        $this->repository->add_update(
            $this->weight,
            $this->food,
            date('Ymd', strtotime('today')),
            $this->racer->id
        );
    }
}
