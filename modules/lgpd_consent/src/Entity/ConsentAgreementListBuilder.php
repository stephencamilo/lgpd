<?php

namespace Drupal\lgpd_consent\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Provides a list controller for lgpd_consent entities.
 *
 * @ingroup lgpd_consent
 */
class ConsentAgreementListBuilder extends EntityListBuilder {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [
      'title' => $this->t('Title'),
      'mode' => $this->t('Implicit/Explicit'),
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row = [
      'title' => $entity->get('title')->value,
      'mode' => $entity->get('mode')->value,
    ];
    return $row + parent::buildRow($entity);
  }

}
