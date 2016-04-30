<?php
/**
 * This controller will allow a service to pull steps in the building process.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Controller;


use Engine\EngineBundle\Controller\ModelBasedController;

use ThirdEngine\PropelSOABundle\Base\SymfonyClassInfo;
use ThirdEngine\PropelSOABundle\Interfaces\Collectionable;

use Symfony\Component\HttpFoundation\Request;



/**
 * @route /turnkey/buildProcess
 */
class BuildProcessController extends ModelBasedController implements Collectionable
{
  /**
   * This method points our controller to the proper table.
   */
  public function setupClassInfo()
  {
    $this->classInfo = new SymfonyClassInfo();

    $this->classInfo->namespace = 'Clients';
    $this->classInfo->bundle    = 'TurnKey';
    $this->classInfo->entity    = 'BuildProcess';
  }

  /**
   * This action will return a list of steps in the building process.
   *
   * @route /public/turnkey/buildProcess
   *
   * @Route("/buildProcess")
   * @Method({"GET"})
   *
   * @param Request $request
   */
  public function getAction(Request $request)
  {
    return parent::getAction($request);
  }
}