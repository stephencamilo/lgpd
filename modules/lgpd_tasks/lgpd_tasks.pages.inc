<?php

/**
 * @file
 * Contains lgpd_tasks.pages.inc.
 *
 * Page callback for Task entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Task templates.
 *
 * Default template: lgpd_task.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 *
 * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
 * @throws \Drupal\Component\Plugin\Exception\PluginException
 * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
 * @throws \Drupal\Core\Entity\EntityMalformedException
 */
function template_preprocess_lgpd_task(array &$variables) {
  // Fetch Task Entity Object.
  /** @var \Drupal\lgpd_tasks\Entity\TaskInterface $lgpdTask */
  $lgpdTask = $variables['elements']['#lgpd_task'];

  $bundleStorage = \Drupal::entityTypeManager()->getStorage($lgpdTask->getEntityType()->getBundleEntityType());
  $variables['type'] = $bundleStorage->load($lgpdTask->bundle())->label();

  /** @var \Drupal\lgpd_tasks\Entity\TaskInterface $entity */
  switch ($lgpdTask->bundle()) {
    case 'lgpd_remove':
      /** @var \Drupal\lgpd_tasks\Traversal\RightToBeForgottenDisplayTraversal $traverser */
      $traverser = \Drupal::service('lgpd_tasks.rtf_display_traversal')->getTraversal($lgpdTask->getOwner());
      $rows = $traverser->getResults();

      $variables['data'] = [
        '#type' => 'table',
        '#header' => [
          t('Name'),
          t('Type'),
          t('Entity'),
          t('Bundle'),
          t('Notes'),
          t('Right to be forgotten'),
          '',
        ],
        '#rows' => $rows,
        '#sticky' => TRUE,
        '#empty' => t('There are no lgpd fields.'),
      ];

      $variables['actions'] = \Drupal::service('entity.form_builder')->getForm($lgpdTask, 'process');
      break;

    case 'lgpd_sar':
      /** @var \Drupal\lgpd_tasks\Traversal\RightToAccessDisplayTraversal $traverser */
      $traverser = \Drupal::service('lgpd_tasks.rta_display_traversal')->getTraversal($lgpdTask->getOwner());
      $rows = $traverser->getResults();

      $variables['data'] = [
        '#type' => 'table',
        '#header' => [
          t('Name'),
          t('Type'),
          t('Entity'),
          t('Bundle'),
          t('Notes'),
          t('Right to access'),
        ],
        '#rows' => $rows,
        '#sticky' => TRUE,
        '#empty' => t('There are no lgpd fields.'),
      ];
      $variables['actions'] = \Drupal::service('entity.form_builder')->getForm($lgpdTask, 'process');

      $exportFiles = $lgpdTask->sar_export->getValue();
      if (empty($exportFiles)) {
        unset($variables['actions']['actions']['submit']);
        /** @var \Drupal\Core\Messenger\MessengerInterface $messenger */
        $messenger = \Drupal::service('messenger');
        $messenger->addWarning(t('This SARs Request does not have any files attached, so it cannot be processed. Please run the site cron to generate the files.'));
      }
      break;
  }

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
