<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Data;

class Competition
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
     * @var bool
     */
    public $private;

    /**
     * @var int yyyymmdd
     */
    public $start_date;

    /**
     * @var int yyyymmdd
     */
    public $end_date;

    /**
     * @var string
     */
    public $stake;
}
