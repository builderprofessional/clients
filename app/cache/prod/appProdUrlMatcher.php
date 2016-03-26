<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // app_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'app_homepage');
            }

            return array (  '_controller' => 'Training\\TrainingBundle\\Controller\\DefaultController::indexAction',  '_route' => 'app_homepage',);
        }

        // app_signup
        if ($pathinfo === '/signup') {
            return array (  '_controller' => 'Training\\TrainingBundle\\Controller\\DefaultController::signupAction',  '_route' => 'app_signup',);
        }

        if (0 === strpos($pathinfo, '/public/propelsoa/generate')) {
            // propelsoa_generateobject_route
            if (0 === strpos($pathinfo, '/public/propelsoa/generate/object') && preg_match('#^/public/propelsoa/generate/object/(?P<namespace>[^/]++)/(?P<bundle>[^/]++)/(?P<entity>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'propelsoa_generateobject_route')), array (  '_controller' => 'ThirdEngine\\PropelSOABundle\\Controller\\ObjectGeneratorController::getObjectAction',));
            }

            // propelsoa_generatepartialobject_route
            if (0 === strpos($pathinfo, '/public/propelsoa/generate/partialobject') && preg_match('#^/public/propelsoa/generate/partialobject/(?P<namespace>[^/]++)/(?P<bundle>[^/]++)/(?P<entity>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'propelsoa_generatepartialobject_route')), array (  '_controller' => 'ThirdEngine\\PropelSOABundle\\Controller\\ObjectGeneratorController::getPartialObjectAction',));
            }

            // propelsoa_generatequery_route
            if (0 === strpos($pathinfo, '/public/propelsoa/generate/query') && preg_match('#^/public/propelsoa/generate/query/(?P<namespace>[^/]++)/(?P<bundle>[^/]++)/(?P<entity>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'propelsoa_generatequery_route')), array (  '_controller' => 'ThirdEngine\\PropelSOABundle\\Controller\\ObjectGeneratorController::getQueryAction',));
            }

            // propelsoa_generatecollection_route
            if (0 === strpos($pathinfo, '/public/propelsoa/generate/collection') && preg_match('#^/public/propelsoa/generate/collection/(?P<namespace>[^/]++)/(?P<bundle>[^/]++)/(?P<entity>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'propelsoa_generatecollection_route')), array (  '_controller' => 'ThirdEngine\\PropelSOABundle\\Controller\\ObjectGeneratorController::getCollectionAction',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
