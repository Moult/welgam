<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Data;

class Racer
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int in cm
     */
    public $height;

    /**
     * @var int in kg
     */
    public $weight;

    /**
     * @var bool
     */
    public $male;

    /**
     * @var Race
     */
    public $race;

    /**
     * @var int in kg
     */
    public $goal_weight;

    /**
     * @var Competition
     */
    public $competition;
}
