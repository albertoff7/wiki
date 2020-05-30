<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* partials/footer.html.twig */
class __TwigTemplate_79bc3ae2f62d4fefc9f94ad69e8672e71a77ce431f0bd623df0252e09e307b76 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<section id=\"footer\" class=\"section\">
    <section class=\"container ";
        // line 2
        echo ($context["grid_size"] ?? null);
        echo "\">
        <p>Creado usando <a href=\"http://getgrav.org\">Grav</a> con <i class=\"fa fa-heart-o pulse \"></i> por <a href=\"http://alberto.ws\">Alberto Fernandez</a>.</p>
    </section>
</section>
";
    }

    public function getTemplateName()
    {
        return "partials/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<section id=\"footer\" class=\"section\">
    <section class=\"container {{ grid_size }}\">
        <p>Creado usando <a href=\"http://getgrav.org\">Grav</a> con <i class=\"fa fa-heart-o pulse \"></i> por <a href=\"http://alberto.ws\">Alberto Fernandez</a>.</p>
    </section>
</section>
", "partials/footer.html.twig", "/var/www/html/user/themes/learn4/templates/partials/footer.html.twig");
    }
}
