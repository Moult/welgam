<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Add;

interface Repository
{
    /**
     * @return bool
     */
    public function does_racer_exist($racer_id, $racer_password);

    /**
     * @return bool
     */
    public function does_update_exist($update_date, $racer_id);

    /**
     * @return void
     */
    public function add_update($update_date, $update_food, $update_date, $racer_id);

    /**
     * @return array($competition_id, $competition_start_date, $competition_end_date)
     */
    public function get_competition_id_and_start_and_end_dates($racer_id);

    /**
     * @return void
     */
    public function add_award($award_type, $racer_id);

    /**
     * @return array($racer_weight, $racer_height, $racer_goal_weight)
     */
    public function get_weight_and_height_and_goal_weight($racer_id);

    /**
     * @return array($update_date, $update_weight)
     */
    public function get_previous_update_date_and_weight($racer_id);
}
