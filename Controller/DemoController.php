<?php

namespace Ekyna\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * DemoController
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class DemoController extends Controller
{
    public function homeAction()
    {
        return $this->render('EkynaDemoBundle:Demo:home.html.twig');
    }

    public function defaultAction()
    {
        return $this->render('EkynaDemoBundle:Demo:default.html.twig');
    }

    public function contactAction()
    {
        return $this->render('EkynaDemoBundle:Demo:contact.html.twig');
    }
}
