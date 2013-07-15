<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Delete;

interface Repository
{
    /**
     * @return bool
     */
    public function is_racer_part_of_competition($racer_id, $racer_password, $competition_id);

    /**
     * @return void
     */
    public function delete_competition($competition_id);
}
