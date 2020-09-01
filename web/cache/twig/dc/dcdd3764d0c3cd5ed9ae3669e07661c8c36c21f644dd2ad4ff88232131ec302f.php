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

/* partials/toc.html.twig */
class __TwigTemplate_1684aca470bad6ebedb016ccaab4dff1dd6e3b6db45727d97447d7add12dfec4 extends \Twig\Template
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
        if (($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.page-toc.active"], "method") || $this->getAttribute($this->getAttribute($this->getAttribute(($context["page"] ?? null), "header", []), "page-toc"), "active", []))) {
            // line 2
            echo "  <div class=\"page-toc\">
    ";
            // line 3
            $context["table_of_contents"] = call_user_func_array($this->env->getFunction('toc')->getCallable(), [$this->getAttribute(($context["page"] ?? null), "content", [])]);
            // line 4
            echo "    ";
            if ( !twig_test_empty(($context["table_of_contents"] ?? null))) {
                // line 5
                echo "      <span class=\"toc-toggle\"><i class=\"fa fa-angle-up\"></i></span>
      <h5>Menú rápido</h5>
      ";
                // line 7
                echo ($context["table_of_contents"] ?? null);
                echo "
    ";
            }
            // line 9
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "partials/toc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 9,  44 => 7,  40 => 5,  37 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% if config.get('plugins.page-toc.active') or attribute(page.header, 'page-toc').active %}
  <div class=\"page-toc\">
    {% set table_of_contents = toc(page.content) %}
    {% if table_of_contents is not empty %}
      <span class=\"toc-toggle\"><i class=\"fa fa-angle-up\"></i></span>
      <h5>Menú rápido</h5>
      {{ table_of_contents|raw }}
    {% endif %}
  </div>
{% endif %}
", "partials/toc.html.twig", "/var/www/html/user/themes/learn4/templates/partials/toc.html.twig");
    }
}
