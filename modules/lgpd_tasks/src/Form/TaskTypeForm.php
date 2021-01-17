<?php

namespace Drupal\lgpd_tasks\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class Task Type Form.
 */
class TaskTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $lgpd_task_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $lgpd_task_type->label(),
      '#description' => $this->t("Label for the Task type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $lgpd_task_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\lgpd_tasks\Entity\TaskType::load',
      ],
      '#disabled' => !$lgpd_task_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $lgpd_task_type = $this->entity;
    $status = $lgpd_task_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Task type.', [
          '%label' => $lgpd_task_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Task type.', [
          '%label' => $lgpd_task_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($lgpd_task_type->toUrl('collection'));
  }

}
