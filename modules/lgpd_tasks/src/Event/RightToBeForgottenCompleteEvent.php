<?php

namespace Drupal\lgpd_tasks\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event fired once a Right to be Forgotten event is complete.
 *
 * @package Drupal\lgpd_tasks\Event
 */
class RightToBeForgottenCompleteEvent extends Event {

  const EVENT_NAME = 'lgpd_tasks.rules_rtf_complete';

  /**
   * The recipient's email address.
   *
   * This is not a full reference to the user as all data has been anonymized.
   *
   * @var string
   */
  public $email;

  /**
   * Constructs the object.
   *
   * @param string $email
   *   The user for whom the request was made.
   */
  public function __construct($email) {
    $this->email = $email;
  }

}
