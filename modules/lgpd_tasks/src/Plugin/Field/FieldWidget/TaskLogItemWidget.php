<?php

namespace Drupal\lgpd_tasks\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'lgpd_task_item' widget.
 *
 * @FieldWidget(
 *   id = "lgpd_task_item",
 *   label = @Translation("lgpd Removal Task Item"),
 *   description = @Translation("lgpd Removal Task Item"),
 *   field_types = {
 *     "lgpd_task_item",
 *   },
 *   multiple_values = TRUE,
 *
 * )
 */
class TaskLogItemWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['entity_id'] = [
      '#type' => 'number',
      '#title' => 'Entity ID',
    ];

    $element['entity_type'] = [
      '#type' => 'textfield',
      '#title' => 'Entity type',
    ];

    $element['field_name'] = [
      '#type' => 'textfield',
      '#title' => 'Field Name',
    ];

    $element['action'] = [
      '#type' => 'textfield',
      '#title' => 'Action',
    ];

    $element['anonymizer'] = [
      '#type' => 'textfield',
      '#title' => 'Anonymizer',
    ];

    return $element;
  }

}
