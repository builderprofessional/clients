<?php

/* TrainingTrainingBundle:Default:index.html.twig */
class __TwigTemplate_45d07805284b450004a4ec97222c52ecf455ab2e9ebaa92033012402a83913c3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta chareset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\">
  <title>BuilderTraining.net</title>
  <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"images/favicon.ico\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/kernel.css\" />
  <base href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getBaseUrl", array(), "method"), "html", null, true);
        echo "\">

  <script>
    //optional need to be loaded before kernel for file uploads to work on older browsers
    FileAPI = {
      jsPath: '/FileAPI/FileAPI.min.js',
      staticPath: '/FileAPI/FileAPI.flash.swf',
    }
  </script>
</head>
<body class=\"eng-auth-application waiting-for-angular\">
<div id=\"initializing-panel\">
  <div class=\"waiting-loader\"></div>
</div>
<eng-alerts class=\"all-alerts\"></eng-alerts>
<!--
<div class=\"all-alerts\">
  <eng-alert-box alert-type=\"error\"></eng-alert-box>
  <eng-alert-box alert-type=\"fielderror\"></eng-alert-box>
  <eng-alert-box alert-type=\"warning\"></eng-alert-box>
  <eng-alert-box alert-type=\"success\"></eng-alert-box>
  <eng-alert-box alert-type=\"info\"></eng-alert-box>
</div>
-->
<eng-view-navbar></eng-view-navbar>
<eng-view-login></eng-view-login>


<!--Main Content-->
<div id=\"content\" class=\"container\" ui-view=\"content\"></div>


<!-- Include all javascript at bottom of body per best practices for performance -->
<script src=\"kernel.js\"></script>
<script>
  launchPropelSOA(engApp, true, domain, null, true);
  launchPropelSOA(trainingApp, true, domain, null, true);
</script>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "TrainingTrainingBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 9,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* <head>*/
/*   <meta chareset="utf-8">*/
/*   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">*/
/*   <title>BuilderTraining.net</title>*/
/*   <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">*/
/*   <link rel="stylesheet" type="text/css" href="/css/kernel.css" />*/
/*   <base href="{{ app.request.getBaseUrl() }}">*/
/* */
/*   <script>*/
/*     //optional need to be loaded before kernel for file uploads to work on older browsers*/
/*     FileAPI = {*/
/*       jsPath: '/FileAPI/FileAPI.min.js',*/
/*       staticPath: '/FileAPI/FileAPI.flash.swf',*/
/*     }*/
/*   </script>*/
/* </head>*/
/* <body class="eng-auth-application waiting-for-angular">*/
/* <div id="initializing-panel">*/
/*   <div class="waiting-loader"></div>*/
/* </div>*/
/* <eng-alerts class="all-alerts"></eng-alerts>*/
/* <!--*/
/* <div class="all-alerts">*/
/*   <eng-alert-box alert-type="error"></eng-alert-box>*/
/*   <eng-alert-box alert-type="fielderror"></eng-alert-box>*/
/*   <eng-alert-box alert-type="warning"></eng-alert-box>*/
/*   <eng-alert-box alert-type="success"></eng-alert-box>*/
/*   <eng-alert-box alert-type="info"></eng-alert-box>*/
/* </div>*/
/* -->*/
/* <eng-view-navbar></eng-view-navbar>*/
/* <eng-view-login></eng-view-login>*/
/* */
/* */
/* <!--Main Content-->*/
/* <div id="content" class="container" ui-view="content"></div>*/
/* */
/* */
/* <!-- Include all javascript at bottom of body per best practices for performance -->*/
/* <script src="kernel.js"></script>*/
/* <script>*/
/*   launchPropelSOA(engApp, true, domain, null, true);*/
/*   launchPropelSOA(trainingApp, true, domain, null, true);*/
/* </script>*/
/* </body>*/
/* </html>*/
/* */
