<?php

namespace Drupal\lgpd_tasks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\lgpd_tasks\Entity\Task;

/**
 * Form for user task requests.
 */
class CreatelgpdRequestOnBehalfOfUserForm extends FormBase {
  /**
   * The lgpd_tasks_process_lgpd_sar queue.
   *
   * @var \Drupal\Core\Queue\QueueInterface
   */
  protected $queue;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('queue')
    );
  }

  /**
   * Constructs a new CreatelgpdRequestOnBehalfOfUserForm.
   *
   * @param \Drupal\Core\Queue\QueueFactory $queue
   *   Queue factory.
   */
  public function __construct(QueueFactory $queue) {
    $this->queue = $queue->get('lgpd_tasks_process_lgpd_sar');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lgpd_tasks_create_request_on_behalf_of_user';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    return [
      '#title' => $this->t('Create request on behalf of user'),
      'notes' => [
        '#type' => 'textarea',
        '#title' => $this->t('Notes'),
        '#description' => $this->t('Enter the reason for creating this request.'),
      ],
      'actions' => [
        '#type' => 'actions',
        'submit' => [
          '#type' => 'submit',
          '#value' => $this->t('Create Request'),
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = $this->getRouteMatch()->getParameter('user');
    $request_type = $this->getRouteMatch()->getParameter('lgpd_task_type');
    $notes = $form_state->getValue('notes');

    $task = Task::create([
      'type' => $request_type,
      'user_id' => $user->id(),
      'notes' => $notes,
    ]);
    $task->save();

    if ($request_type === 'lgpd_sar') {
      $this->queue->createQueue();
      $this->queue->createItem($task->id());
    }

    $this->messenger()->addStatus('The request has been logged');
    $form_state->setRedirect('view.lgpd_tasks_my_data_requests.page_1', ['user' => $user->id()]);
  }

}
