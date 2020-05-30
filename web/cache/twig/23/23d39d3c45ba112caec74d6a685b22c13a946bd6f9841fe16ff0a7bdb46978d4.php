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

/* docs.html.twig */
class __TwigTemplate_c4275f7a406fa9d3737783b7f56fd8cf1940659a21edf3ca41c5c159addc98fa extends \Twig\Template
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
        return "partials/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["body_classes"] = ((($context["body_classes"] ?? null) . " ") . $this->getAttribute($this->getAttribute(($context["page"] ?? null), "header", []), "body_classes", []));
        // line 4
        $context["tags"] = $this->getAttribute($this->getAttribute(($context["page"] ?? null), "taxonomy", []), "tag", []);
        // line 5
        if (($context["tags"] ?? null)) {
            // line 6
            $context["progress"] = $this->getAttribute(($context["page"] ?? null), "collection", [0 => ["items" => ["@taxonomy" => ["category" => "docs", "tag" => ($context["tags"] ?? null)]], "order" => ["by" => "default", "dir" => "asc"]]], "method");
        } else {
            // line 8
            $context["progress"] = $this->getAttribute(($context["page"] ?? null), "collection", [0 => ["items" => ["@taxonomy" => ["category" => "docs"]], "order" => ["by" => "default", "dir" => "asc"]]], "method");
        }
        // line 2
        $this->parent = $this->loadTemplate("partials/base.html.twig", "docs.html.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    public function block_content($context, array $blocks = [])
    {
        // line 12
        echo "    ";
        $this->loadTemplate("partials/toc.html.twig", "docs.html.twig", 12)->display($context);
        // line 13
        echo "
    ";
        // line 14
        $this->loadTemplate("partials/page.html.twig", "docs.html.twig", 14)->display($context);
        // line 15
        echo "
    ";
        // line 16
        $this->loadTemplate("partials/github-note.html.twig", "docs.html.twig", 16)->display($context);
    }

    public function getTemplateName()
    {
        return "docs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 16,  63 => 15,  61 => 14,  58 => 13,  55 => 12,  52 => 11,  47 => 2,  44 => 8,  41 => 6,  39 => 5,  37 => 4,  35 => 1,  29 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set body_classes = body_classes ~ ' ' ~ page.header.body_classes %}
{% extends 'partials/base.html.twig' %}

{% set tags = page.taxonomy.tag %}
{% if tags %}
    {% set progress = page.collection({'items':{'@taxonomy':{'category': 'docs', 'tag': tags}},'order': {'by': 'default', 'dir': 'asc'}}) %}
{% else %}
    {% set progress = page.collection({'items':{'@taxonomy':{'category': 'docs'}},'order': {'by': 'default', 'dir': 'asc'}}) %}
{% endif %}

{% block content %}
    {% include 'partials/toc.html.twig' %}

    {% include 'partials/page.html.twig' %}

    {% include 'partials/github-note.html.twig' %}
{% endblock %}
", "docs.html.twig", "/var/www/html/user/themes/learn4/templates/docs.html.twig");
    }
}
