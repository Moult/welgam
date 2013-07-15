<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Edit;

interface Repository
{
    /**
     * @return bool
     */
    public function is_racer_part_of_competition($racer_id, $racer_password, $competition_id);

    /**
     * @return int
     */
    public function get_competition_start_date($competition_id);

    /**
     * @return void
     */
    public function update_competition($competition_id, $competition_name, $competition_end_date);
}
