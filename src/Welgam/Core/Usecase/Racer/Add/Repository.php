<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Add;

interface Repository
{
    /**
     * @return bool
     */
    public function does_competition_exist($competition_id);

    /**
     * @return int Unique ID of added racer
     */
    public function add_racer($name, $password, $email, $height, $weight, $male, $race, $goal_weight, $competition_id);

    /**
     * @return string
     */
    public function get_competition_name($competition_id);
}
