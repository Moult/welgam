<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Welgam\Core\Usecase\Competition\Edit;

class Interactor
{
    private $editor;
    private $submission;

    public function __construct(Editor $editor, Submission $submission)
    {
        $this->editor = $editor;
        $this->submission = $submission;
    }

    public function interact()
    {
        $this->editor->authorise_participant();
        $this->submission->validate();
        $this->submission->update();
    }
}
