<?php

namespace Drupal\users_list\Controller;

use Drupal\users_list\service\PhpSpreadSheetService;

class UserController
{
    protected $spreadSheetService;



//    public function __construct(PhpSpreadSheetService $spreadSheetService)
//    {
//      $this->spreadSheetService = $spreadSheetService;
//    }
    public function list_of_users()
    {
//      $barista = \Drupal::getContainer()
//        ->get(PhpSpreadSheetService::class);
      $class = \Drupal::service('users_list.php_spread_sheet_service');
      return $class->spreadSheet();
    }
}
