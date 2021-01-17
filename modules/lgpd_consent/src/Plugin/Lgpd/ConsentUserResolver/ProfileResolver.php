<?php

namespace Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver;

use Drupal\Core\Entity\EntityInterface;
use Drupal\lgpd_consent\ConsentUserResolver\lgpdConsentUserResolverInterface;

/**
 * Resolves user reference for a Profile entity.
 *
 * @lgpdConsentUserResolver(
 *   id = "lgpd_consent_profile_resolver",
 *   label = "lgpd Consent Profile Resolver",
 *   entityType = "profile"
 * )
 * @package Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver
 */
class ProfileResolver implements lgpdConsentUserResolverInterface {

  /**
   * {@inheritdoc}
   */
  public function resolve(EntityInterface $entity) {
    return $entity->uid->entity;
  }

}
