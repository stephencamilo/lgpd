<?php

namespace Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver;

use Drupal\Core\Entity\EntityInterface;
use Drupal\lgpd_consent\ConsentUserResolver\lgpdConsentUserResolverInterface;

/**
 * Resolves user reference for a Profile entity.
 *
 * @lgpdConsentUserResolver(
 *   id = "lgpd_consent_user_resolver",
 *   label = "lgpd Consent User Resolver",
 *   entityType = "user"
 * )
 * @package Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver
 */
class UserResolver implements lgpdConsentUserResolverInterface {

  /**
   * {@inheritdoc}
   */
  public function resolve(EntityInterface $entity) {
    return $entity;
  }

}
