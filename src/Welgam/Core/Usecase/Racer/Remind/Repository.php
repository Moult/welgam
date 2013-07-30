<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Racer\Remind;

interface Repository
{
    /**
     * @return bool
     */
    public function does_racer_with_email_exist($email);

    /**
     * @return array(
     *             array(
     *                 'competition_name' => $competition1_name,
     *                 'competition_id' => $competition1_id,
     *                 'racer_id' => $racer_id,
     *                 'racer_password' => $racer_password
     *             ),
     *             // etc
     *         )
     */
    public function get_access_details_of_competitions($email);
}
