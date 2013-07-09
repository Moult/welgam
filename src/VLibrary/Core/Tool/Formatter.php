<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace VLibrary\Core\Tool;

interface Formatter
{
    /**
     * Sets up the formatter with data to use
     *
     * Example:
     * $data = VLibrary\Core\Data\User;
     * $formatter->setup($data);
     *
     * @param Data $data A data object
     *
     * @return void
     */
    public function setup($data);

    /**
     * Formats the data in the template specified
     *
     * Example:
     * $formatter->format('Email_Notification');
     *
     * @param string $template The name of the formatting template to use
     *
     * @return string
     */
    public function format($template);
}
