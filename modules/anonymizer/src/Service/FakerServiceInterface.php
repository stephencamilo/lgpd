<?php

namespace Drupal\anonymizer\Service;

/**
 * Interface Faker Service Interface.
 *
 * @package Drupal\anonymizer\Service
 */
interface FakerServiceInterface {

  /**
   * Return the generator.
   *
   * @return \Faker\Generator
   *   The generator.
   */
  public function generator();

}
