<?php

namespace Drupal\lgpd_tasks\Traversal;

use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\lgpd_fields\Entity\lgpdField;
use Drupal\lgpd_fields\Entity\lgpdFieldConfigEntity;
use Drupal\lgpd_fields\EntityTraversal;

/**
 * Entity traversal for the Right to Access preview display.
 *
 * @package Drupal\lgpd_tasks
 */
class RightToAccessDisplayTraversal extends EntityTraversal {

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   */
  protected function processEntity(FieldableEntityInterface $entity, lgpdFieldConfigEntity $config, $row_id, lgpdField $parent_config = NULL) {
    $entity_type = $entity->getEntityTypeId();
    $entity_definition = $entity->getEntityType();

    $fields = $this->entityFieldManager->getFieldDefinitions($entity_type, $entity->bundle());
    $field_configs = $config->getFieldsForBundle($entity->bundle());

    foreach ($fields as $field_id => $field) {
      $field_config = isset($field_configs[$field_id]) ? $field_configs[$field_id] : NULL;

      // If the field is not configured, not enabled,
      // or not enabled for RTA, then skip it.
      if ($field_config === NULL
        || !$field_config->enabled
        || !in_array($field_config->rta, ['inc', 'maybe'])) {
        continue;
      }

      $key = "$entity_type.{$entity->id()}.$field_id";

      $field_value = $entity->get($field_id)->getString();

      $this->results[$key] = [
        'title' => $field->getLabel(),
        'value' => $field_value,
        'entity' => $entity_definition->getLabel(),
        'bundle' => $this->getBundleLabel($entity),
        'notes' => $field_config->notes,
        'lgpd_rta' => $field_config->rta,
      ];
    }
  }

}
