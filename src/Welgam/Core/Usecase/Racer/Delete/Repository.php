<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Delete;

interface Repository
{
    /**
     * @return bool
     */
    public function does_racer_exist($racer_id, $racer_password);

    /**
     * @return void
     */
    public function delete_racer($racer_id);
}
