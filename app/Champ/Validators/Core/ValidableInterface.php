<?php namespace Champ\Validators\Core;

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