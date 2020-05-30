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

/* partials/sidebar.html.twig */
class __TwigTemplate_ab737ea720d3a7c7ce4544677adbdbfcd7525bb79734296ed08dda43beb3b522 extends \Twig\Template
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
        $context["macros"] = $this->loadTemplate("macros/macros.html.twig", "partials/sidebar.html.twig", 1)->unwrap();
        // line 2
        echo "
<div class=\"learn-brand\">
    <div id=\"header\">
        <a id=\"logo\" href=\"";
        // line 5
        echo (($this->getAttribute(($context["theme_config"] ?? null), "home_url", [])) ? ($this->getAttribute(($context["theme_config"] ?? null), "home_url", [])) : (($context["base_url_absolute"] ?? null)));
        echo "\">";
        $this->loadTemplate("partials/logo.html.twig", "partials/sidebar.html.twig", 5)->display($context);
        echo "</a>
        <div class=\"searchbox\">
            <label for=\"search-by\"><i class=\"fa fa-search\"></i></label>
            <input id=\"search-by\" type=\"text\" placeholder=\"";
        // line 8
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, "THEME_LEARN4_SEARCH_DOCUMENTATION");
        echo "\"
                   data-search-input=\"";
        // line 9
        echo ($context["base_url_relative"] ?? null);
        echo "/s/q\"/>
            <span data-search-clear><i class=\"fa fa-close\"></i></span>
        </div>
    </div>
</div>
<div class=\"learn-nav\" data-simplebar>
    <div class=\"highlightable\">
        ";
        // line 16
        if ($this->getAttribute(($context["theme_config"] ?? null), "top_level_version", [])) {
            // line 17
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pages"] ?? null), "children", []));
            foreach ($context['_seq'] as $context["slug"] => $context["ver"]) {
                // line 18
                echo "                ";
                echo $context["macros"]->getversion($context["ver"]);
                echo "
                <ul id=\"";
                // line 19
                echo $context["slug"];
                echo "\" class=\"topics\">
                ";
                // line 20
                echo $context["macros"]->getloop($context["ver"], "");
                echo "
                </ul>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['slug'], $context['ver'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "        ";
        } else {
            // line 24
            echo "            <ul class=\"topics\">
                ";
            // line 25
            if ($this->getAttribute(($context["theme_config"] ?? null), "root_page", [])) {
                // line 26
                echo "                    ";
                echo $context["macros"]->getloop($this->getAttribute(($context["page"] ?? null), "find", [0 => $this->getAttribute(($context["theme_config"] ?? null), "root_page", [])], "method"), "");
                echo "
                ";
            } else {
                // line 28
                echo "            ";
                echo $context["macros"]->getloop(($context["pages"] ?? null), "");
                echo "
                ";
            }
            // line 30
            echo "            </ul>
        ";
        }
        // line 32
        echo "        <hr />

        <a class=\"side-tools padding\" href=\"#\" data-clear-history-toggle>
            <i class=\"fa fa-fw fa-history\"></i> ";
        // line 35
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, "THEME_LEARN4_CLEAR_HISTORY");
        echo "
        </a><br/>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "partials/sidebar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 35,  108 => 32,  104 => 30,  98 => 28,  92 => 26,  90 => 25,  87 => 24,  84 => 23,  75 => 20,  71 => 19,  66 => 18,  61 => 17,  59 => 16,  49 => 9,  45 => 8,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% import 'macros/macros.html.twig' as macros %}

<div class=\"learn-brand\">
    <div id=\"header\">
        <a id=\"logo\" href=\"{{ theme_config.home_url ?: base_url_absolute }}\">{% include 'partials/logo.html.twig' %}</a>
        <div class=\"searchbox\">
            <label for=\"search-by\"><i class=\"fa fa-search\"></i></label>
            <input id=\"search-by\" type=\"text\" placeholder=\"{{ 'THEME_LEARN4_SEARCH_DOCUMENTATION'|t }}\"
                   data-search-input=\"{{ base_url_relative }}/s/q\"/>
            <span data-search-clear><i class=\"fa fa-close\"></i></span>
        </div>
    </div>
</div>
<div class=\"learn-nav\" data-simplebar>
    <div class=\"highlightable\">
        {% if theme_config.top_level_version %}
            {% for slug, ver in pages.children %}
                {{ macros.version(ver) }}
                <ul id=\"{{ slug }}\" class=\"topics\">
                {{ macros.loop(ver, '') }}
                </ul>
            {% endfor %}
        {% else %}
            <ul class=\"topics\">
                {% if theme_config.root_page %}
                    {{ macros.loop(page.find(theme_config.root_page), '') }}
                {% else %}
            {{ macros.loop(pages, '') }}
                {% endif %}
            </ul>
        {% endif %}
        <hr />

        <a class=\"side-tools padding\" href=\"#\" data-clear-history-toggle>
            <i class=\"fa fa-fw fa-history\"></i> {{ 'THEME_LEARN4_CLEAR_HISTORY'|t }}
        </a><br/>
    </div>
</div>
", "partials/sidebar.html.twig", "/var/www/html/user/themes/learn4/templates/partials/sidebar.html.twig");
    }
}
