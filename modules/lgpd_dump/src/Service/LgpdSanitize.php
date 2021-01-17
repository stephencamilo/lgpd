<?php

namespace Drupal\lgpd_dump\Service;

/**
 * Class Lgpd Sql Dump.
 *
 * @package Drupal\lgpd_dump\Service
 */
class LgpdSanitize extends LgpdSqlDump {

  /**
   * Go through the data and sanitize it.
   *
   * @throws \Exception
   */
  public function sanitize() {
    $this->prepare();
    $this->rename();
  }

  /**
   * Rename the cloned tables to the original tables.
   */
  protected function rename() {
    $transaction = $this->database->startTransaction('lgpd_rename_table');

    foreach (\array_keys($this->tablesToAnonymize) as $table) {
      $lgpdTable = self::lgpd_TABLE_PREFIX . $table;
      $this->database->schema()->dropTable($table);
      $this->database->schema()->renameTable($lgpdTable, $table);
    }

    $this->database->popTransaction($transaction->name());
  }

}
