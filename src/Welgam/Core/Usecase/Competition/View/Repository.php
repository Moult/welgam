<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\View;

interface Repository
{
    /**
     * @return bool
     */
    public function does_competition_have_racers($competition_id);

    /**
     * @return array(
     *     'name' => $competition_name,
     *     'start_date' => $competition_start_date,
     *     'end_Date' => $competition_end_date,
     *     'stake' => $competition_stake,
     *     'racers' => array(
     *         array(
     *             'id' => $racer_id,
     *             'name' => $racer_name,
     *             'password' => $racer_password,
     *             'email' => $racer_email,
     *             'height' => $racer_height,
     *             'weight' => $racer_weight',
     *             'goal_weight' => $racer_goal_weight,
     *             'updates' => array(
     *                 array(
     *                     'id' => $update_id,
     *                     'weight' => $update_weight,
     *                     'date' => $update_date,
     *                     'food' => $update_food,
     *                     'racer' => $racer_id,
     *                     'awards' => 'a,b,c,d,e'
     *                 ),
     *                 ...
     *             )
     *         ),
     *         ...
     *     )
     * )
     */
    public function get_competition_details($competition_id);

    /**
     * @return bool
     */
    public function does_competition_have_racer($competition_id, $racer_id, $racer_password);
}
