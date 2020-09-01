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

/* partials/topbar.html.twig */
class __TwigTemplate_1bfa2c4ac59a3250fd13d91b635363debad3af86b89c0c401feb4fd8cd3355d1 extends \Twig\Template
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
        echo "<div id=\"top-bar\">
  ";
        // line 2
        if ((($context["github_link_position"] ?? null) == "top")) {
            // line 3
            echo "    <div id=\"top-github-link\">
      ";
            // line 4
            $this->loadTemplate("partials/github_link.html.twig", "partials/topbar.html.twig", 4)->display($context);
            // line 5
            echo "    </div>
  ";
        }
        // line 7
        echo "
  ";
        // line 8
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "breadcrumbs", []), "enabled", [])) {
            // line 9
            echo "    ";
            $this->loadTemplate("partials/breadcrumbs.html.twig", "partials/topbar.html.twig", 9)->display($context);
            // line 10
            echo "  ";
        }
        // line 11
        echo "
  <div id=\"navigation\">
    ";
        // line 13
        if ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->themeVarFunc("github.link")) {
            // line 14
            echo "      ";
            $this->loadTemplate("partials/github-link.html.twig", "partials/topbar.html.twig", 14)->display($context);
            // line 15
            echo "    ";
        }
        // line 16
        echo "    ";
        if ( !$this->getAttribute(($context["progress"] ?? null), "isFirst", [0 => $this->getAttribute(($context["page"] ?? null), "path", [])], "method")) {
            // line 17
            echo "      <a class=\"nav-prev tooltip tooltip-bottom\" data-tooltip=\"Pagina anterior [&larr;]\" href=\"";
            echo $this->getAttribute($this->getAttribute(($context["progress"] ?? null), "nextSibling", [0 => $this->getAttribute(($context["page"] ?? null), "path", [])], "method"), "url", []);
            echo "\"> <i class=\"fa fa-angle-left\"></i></a>
    ";
        } else {
            // line 19
            echo "      <span class=\"disabled\"><i class=\"fa fa-angle-left\"></i></span>
    ";
        }
        // line 21
        echo "    ";
        if ( !$this->getAttribute(($context["progress"] ?? null), "isLast", [0 => $this->getAttribute(($context["page"] ?? null), "path", [])], "method")) {
            // line 22
            echo "      <a class=\"nav-next tooltip tooltip-bottom\" data-tooltip=\"Pagina siguiente [&rarr;]\" href=\"";
            echo $this->getAttribute($this->getAttribute(($context["progress"] ?? null), "prevSibling", [0 => $this->getAttribute(($context["page"] ?? null), "path", [])], "method"), "url", []);
            echo "\"><i class=\"fa fa-angle-right\"></i></a>
    ";
        } else {
            // line 24
            echo "      <span class=\"disabled\"><i class=\"fa fa-angle-right\"></i></span>
    ";
        }
        // line 26
        echo "  </div>
  <div class=\"progress\"></div>
</div>


";
    }

    public function getTemplateName()
    {
        return "partials/topbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 26,  89 => 24,  83 => 22,  80 => 21,  76 => 19,  70 => 17,  67 => 16,  64 => 15,  61 => 14,  59 => 13,  55 => 11,  52 => 10,  49 => 9,  47 => 8,  44 => 7,  40 => 5,  38 => 4,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<div id=\"top-bar\">
  {% if  github_link_position == 'top' %}
    <div id=\"top-github-link\">
      {% include 'partials/github_link.html.twig' %}
    </div>
  {% endif %}

  {% if config.plugins.breadcrumbs.enabled %}
    {% include 'partials/breadcrumbs.html.twig' %}
  {% endif %}

  <div id=\"navigation\">
    {% if theme_var('github.link') %}
      {% include 'partials/github-link.html.twig' %}
    {% endif %}
    {% if not progress.isFirst(page.path) %}
      <a class=\"nav-prev tooltip tooltip-bottom\" data-tooltip=\"Pagina anterior [&larr;]\" href=\"{{ progress.nextSibling(page.path).url }}\"> <i class=\"fa fa-angle-left\"></i></a>
    {% else %}
      <span class=\"disabled\"><i class=\"fa fa-angle-left\"></i></span>
    {% endif %}
    {% if not progress.isLast(page.path) %}
      <a class=\"nav-next tooltip tooltip-bottom\" data-tooltip=\"Pagina siguiente [&rarr;]\" href=\"{{ progress.prevSibling(page.path).url }}\"><i class=\"fa fa-angle-right\"></i></a>
    {% else %}
      <span class=\"disabled\"><i class=\"fa fa-angle-right\"></i></span>
    {% endif %}
  </div>
  <div class=\"progress\"></div>
</div>


", "partials/topbar.html.twig", "/var/www/html/user/themes/learn4/templates/partials/topbar.html.twig");
    }
}
