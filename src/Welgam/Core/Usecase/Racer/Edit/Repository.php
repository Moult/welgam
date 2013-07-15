<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Edit;

interface Repository
{
    /**
     * @return bool
     */
    public function does_racer_exist($racer_id, $racer_password);

    /**
     * @return void
     */
    public function update_racer($racer_id, $racer_email, $racer_goal_weight);
}
