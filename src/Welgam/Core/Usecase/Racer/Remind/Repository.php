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
     *             array('name' => $competition1_name, 'url' => $competition1_url),
     *             // etc
     *         )
     */
    public function get_competition_names_and_urls_which_racer_is_participating_in($email);
}
