<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Data;

class Award
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Trophy
     */
    public $type;

    /**
     * @var Racer
     */
    public $racer;
}
