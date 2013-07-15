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
}
