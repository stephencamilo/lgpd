<?php

namespace Drupal\lgpd_consent\ConsentUserResolver;

use Drupal\Core\Entity\EntityInterface;

/**
 * Interface Lgpd Consent User Resolver Interface.
 */
interface LgpdConsentUserResolverInterface {

  /**
   * Gets the user reference from the specified entity.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to use when finding the user.
   *
   * @return \Drupal\user\Entity\User
   *   The user
   */
  public function resolve(EntityInterface $entity);

}
