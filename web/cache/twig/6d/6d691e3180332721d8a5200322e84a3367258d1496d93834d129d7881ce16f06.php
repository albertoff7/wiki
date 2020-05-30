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

/* chapter.html.twig */
class __TwigTemplate_0ad46dc5fdd0518cb584356a1a83b8c3f493015bc2af53a4379f2dd14f61d468 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "docs.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["body_classes"] = "center-content";
        // line 2
        $this->parent = $this->loadTemplate("docs.html.twig", "chapter.html.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = [])
    {
        // line 5
        echo "    <div id=\"chapter\">
        ";
        // line 6
        echo $this->getAttribute(($context["page"] ?? null), "content", []);
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "chapter.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 6,  45 => 5,  42 => 4,  37 => 2,  35 => 1,  29 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set body_classes = 'center-content' %}
{% extends 'docs.html.twig' %}

{% block content %}
    <div id=\"chapter\">
        {{ page.content|raw }}
    </div>
{% endblock %}
", "chapter.html.twig", "/var/www/html/user/themes/learn4/templates/chapter.html.twig");
    }
}
