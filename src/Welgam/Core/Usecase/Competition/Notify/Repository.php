<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Notify;

interface Repository
{
    /**
     * @return array(
     *     array($competition_id, $competition_name),
     *     ...
     * );
     */
    public function get_competition_ids_and_names();

    /**
     * @return array(
     *     array($racer_id, $racer_password, $racer_name, $racer_email),
     *     ...
     * );
     */
    public function get_racers_ids_passwords_names_emails($competition_id);
}
