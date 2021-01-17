<?php

namespace Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver;

use Drupal\Core\Entity\EntityInterface;
use Drupal\lgpd_consent\ConsentUserResolver\lgpdConsentUserResolverInterface;

/**
 * Resolves user reference for a Node entity.
 *
 * @lgpdConsentUserResolver(
 *   id = "lgpd_consent_node_resolver",
 *   label = "lgpd Consent Node Resolver",
 *   entityType = "node"
 * )
 * @package Drupal\lgpd_consent\Plugin\lgpd\ConsentUserResolver
 */
class NodeResolver implements lgpdConsentUserResolverInterface {

  /**
   * {@inheritdoc}
   */
  public function resolve(EntityInterface $entity) {
    return $entity->uid->entity;
  }

}
