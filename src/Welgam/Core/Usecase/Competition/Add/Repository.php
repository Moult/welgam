<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Add;

interface Repository
{
    /**
     * @return int Unique ID of saved competition
     */
    public function add_competition($name, $private, $start_date, $end_date, $stake);
}
