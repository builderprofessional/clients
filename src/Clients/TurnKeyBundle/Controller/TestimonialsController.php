<?php
/**
 * This controller publishes an API that will pull information about a list of customer testimonials.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Controller;


use ThirdEngine\PropelSOABundle\Http\PropelSOASuccessResponse;
use ThirdEngine\PropelSOABundle\Controller\ServiceController;

use Symfony\Component\HttpFoundation\Request;



/**
 * @route /turnkey/testimonials
 */
class TestimonialsController extends ServiceController
{
  /**
   * @Route("/testimonials")
   * @Method({"GET"})
   *
   * @param Request $request
   */
  public function getAction(Request $request)
  {
    $text1 = "\"This letter is to recommend Burghli Homes; working with this contractor was a
      pleasure. They were very thorough throughout the whole building process and communicated
      consistently with me throughout the whole build, not to mention they finished the project
      in a very timely manner. I couldn't be more satisfied with this contractor.\"
      <br /><br />Very respectfully,<br /><span class='testimonial-name'>Victor Cervantes</span>";

    $text2 = "\"On behalf of my mother, Mary Compean, I would like to thank Burghli Homes
      for exceeding expectations in the rebuilding of her home.\"
      <br /><br />With kind regards,<br /><span class='testimonial-name'>Delia Molina</span>";

    $response = [
      [
        'photo1' => 'testimonial_1_1.jpg',
        'photo2' => 'testimonial_1_2.jpg',
        'video' => '',
        'text' => $text1,
      ],
      [
        'photo1' => 'testimonial_2_1.jpg',
        'photo2' => 'testimonial_2_2.jpg',
        'video' => '',
        'text' => $text2,
      ],
    ];


    return new PropelSOASuccessResponse($response, 200);
  }
}