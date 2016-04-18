<?php
/**
 * This controller publishes an API that will pull the right images to display in a turn-key gallery.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Controller;


use ThirdEngine\PropelSOABundle\Http\PropelSOASuccessResponse;
use ThirdEngine\PropelSOABundle\Controller\ServiceController;

use Symfony\Component\HttpFoundation\Request;



/**
 * @route /turnkey/gallery
 */
class GalleryController extends ServiceController
{
  /**
   * @Route("/gallery/{key}")
   * @Method({"GET"})
   *
   * @param Request $request
   * @param string $key
   */
  public function imagesAction(Request $request, $key)
  {
    $photos = [];

    for ($i = 1; $i <= 7; ++$i)
    {
      $photos[] = [
        'category' => 'Exterior',
        'fileName' => 'ext' . $i . '.jpg',
      ];
    }

    for ($i = 1; $i <= 7; ++$i)
    {
      $photos[] = [
        'category' => 'Exterior',
        'fileName' => 'int' . $i . '.jpg',
      ];
    }

    for ($i = 1; $i <= 7; ++$i)
    {
      $photos[] = [
        'category' => 'Exterior',
        'fileName' => 'ext' . $i . '.jpg',
      ];
    }

    for ($i = 1; $i <= 7; ++$i)
    {
      $photos[] = [
        'category' => 'Exterior',
        'fileName' => 'int' . $i . '.jpg',
      ];
    }


    $response = [
      'key' => $key,
      'images' => $photos,
    ];

    return new PropelSOASuccessResponse($response, 200);
  }
}