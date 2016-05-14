<?php
/**
 * This controller publishes an API that will pull information about a list of customer testimonials.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Controller;


use Engine\EngineBundle\Controller\ModelBasedController;

use ThirdEngine\PropelSOABundle\Interfaces\Collectionable;
use ThirdEngine\PropelSOABundle\Http\PropelSOASuccessResponse;
use ThirdEngine\PropelSOABundle\Base\SymfonyClassInfo;

use Symfony\Component\HttpFoundation\Request;



/**
 * @route /turnkey/testimonials
 */
class TestimonialController extends ModelBasedController implements Collectionable
{
  /**
   * This method points our controller to the proper table.
   */
  public function setupClassInfo()
  {
    $this->classInfo = new SymfonyClassInfo();

    $this->classInfo->namespace = 'Clients';
    $this->classInfo->bundle    = 'TurnKey';
    $this->classInfo->entity    = 'Testimonial';
  }

  /**
   * @Route("/testimonials")
   * @Method({"GET"})
   *
   * @param Request $request
   */
  public function getAction(Request $request)
  {
    return parent::getAction($request);
  }
}