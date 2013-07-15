<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Data;

class Update
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int in kg
     */
    public $weight;

    /**
     * @var int yyyymmdd
     */
    public $date;

    /**
     * @var string
     */
    public $food;

    /**
     * @var Racer
     */
    public $racer;
}
