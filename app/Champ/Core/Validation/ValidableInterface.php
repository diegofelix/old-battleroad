<?php namespace Champ\Core\Validation;

interface ValidableInterface {

  /**
   * Passes
   *
   * @return boolean
   */
  public function passes($data, $ruleset = []);

  /**
   * Errors
   *
   * @return array
   */
  public function errors();

}