<?php

namespace Drupal\drupalbook\Controller;

class FirstPageController
{
    public function content()
    {
        $element = array(
            '#markup' => 'Hello World!',
        );
        return $element;
    }
}
