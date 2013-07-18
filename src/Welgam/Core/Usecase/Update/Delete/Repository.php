<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Update\Delete;

interface Repository
{
    /**
     * @return array($racer_id, $racer_password)
     */
    public function get_update_owner_id_and_password($update_id);

    /**
     * @return void
     */
    public function delete_update($update_id);

    /**
     * @return int yymmdd
     */
    public function get_update_date($update_id);
}
