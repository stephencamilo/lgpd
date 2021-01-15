<?php

namespace Drupal\lgpd_tasks\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Task type entity.
 *
 * @ConfigEntityType(
 *   id = "lgpd_task_type",
 *   label = @Translation("Task type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lgpd_tasks\TaskTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lgpd_tasks\Form\TaskTypeForm",
 *       "edit" = "Drupal\lgpd_tasks\Form\TaskTypeForm",
 *       "delete" = "Drupal\lgpd_tasks\Form\TaskTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lgpd_tasks\TaskTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "lgpd_task_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "lgpd_task",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/lgpd/tasks/lgpd_task_type/{lgpd_task_type}",
 *     "add-form" = "/admin/lgpd/tasks/lgpd_task_type/add",
 *     "edit-form" = "/admin/lgpd/tasks/lgpd_task_type/{lgpd_task_type}/edit",
 *     "delete-form" = "/admin/lgpd/tasks/lgpd_task_type/{lgpd_task_type}/delete",
 *     "collection" = "/admin/lgpd/tasks/lgpd_task_type"
 *   }
 * )
 */
class TaskType extends ConfigEntityBundleBase implements TaskTypeInterface {

  /**
   * The Task type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Task type label.
   *
   * @var string
   */
  protected $label;

}
