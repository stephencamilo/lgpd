<?php

namespace Drupal\lgpd_fields\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Url;

/**
 * Delete confirmation form for lgpd field settings.
 */
class LgpdFieldSettingsDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to remove the lgpd settings from this field?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('lgpd_fields.fields_list');
  }

}
