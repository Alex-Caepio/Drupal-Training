<?php

namespace Drupal\users_list\Controller;


class UserController
{
    protected $spreadSheetService;

    public function list_of_users()
    {
      $class = \Drupal::service('users_list.php_spread_sheet_service');
      return $class->spreadSheet();
    }
}
