<?php

/* site/index.twig */
class __TwigTemplate_f8418adfb0b6f8bd0aaa55d11318e235a27489eeb51b3d85027975862a8a36c5 extends Twig_Template
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
<html>
\t<header>
\t\t<title>Home - App</title>
\t\t<link rel=\"stylesheet\" href=\"/styles/site.css\">
\t</header>
\t<body>
\t\t<br>
\t\t<center>
\t\t\t<h1>Insite Site</h1>
\t\t</center>
\t</body>
</html>";
    }

    public function getTemplateName()
    {
        return "site/index.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "site/index.twig", "/var/www/html/apps/views/site/index.twig");
    }
}
