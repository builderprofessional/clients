<?php
/**
 * This is the default entry point for the burghlihomes.com website.
 *
 * @copyright 2016 Builder Professional
 */
namespace Clients\BurngliBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClientsBurngliBundle:Default:index.html.twig');
    }
}
