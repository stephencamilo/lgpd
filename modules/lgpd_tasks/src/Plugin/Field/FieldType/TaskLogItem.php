<?php

namespace Drupal\lgpd_tasks\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * TaskLogItem field type.
 *
 * @FieldType (
 *   id = "lgpd_task_item",
 *   label = @Translation("lgpd Removal Task Item"),
 *   description = @Translation("lgpd Removal Task Item"),
 *   category = @Translation("lgpd"),
 *   default_widget = "lgpd_task_item",
 *   default_formatter = "lgpd_task_item"
 * )
 */
class TaskLogItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['entity_id'] = DataDefinition::create('integer')
      ->setLabel('Entity ID');

    $properties['entity_type'] = DataDefinition::create('string')
      ->setLabel('Entity Type');

    $properties['field_name'] = DataDefinition::create('string')
      ->setLabel('Field Name');

    $properties['action'] = DataDefinition::create('string')
      ->setLabel('Action');

    $properties['anonymizer'] = DataDefinition::create('string')
      ->setLabel('Anonymizer');

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'entity_id' => [
          'type' => 'int',
        ],
        'entity_type' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'field_name' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'action' => [
          'type' => 'varchar',
          'length' => 20,
        ],
        'anonymizer' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ],
    ];
  }

}
