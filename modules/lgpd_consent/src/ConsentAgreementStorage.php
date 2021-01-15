<?php

namespace Drupal\lgpd_consent;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\lgpd_consent\Entity\ConsentAgreementInterface;

/**
 * Defines the storage handler class for Consent Agreement entities.
 *
 * This extends the base storage class, adding required special handling for
 * Consent Agreement entities.
 *
 * @ingroup lgpd_consent
 */
class ConsentAgreementStorage extends SqlContentEntityStorage implements ConsentAgreementStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(ConsentAgreementInterface $entity) {
    return $this->database->query(
      'SELECT revision_id FROM {lgpd_consent_agreement_revision} WHERE id=:id ORDER BY revision_id',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT revision_id FROM {lgpd_consent_agreement_field_revision} WHERE uid = :uid ORDER BY revision_id',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(ConsentAgreementInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {lgpd_consent_agreement_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('lgpd_consent_agreement_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
