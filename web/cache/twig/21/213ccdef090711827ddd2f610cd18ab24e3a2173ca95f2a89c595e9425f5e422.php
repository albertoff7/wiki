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

/* partials/tntsearch.html.twig */
class __TwigTemplate_045e7f68b7759ac34f100fa7974d9f541cc31c30495de1b65a1d2c379b1dd2c8 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'tntsearch_input' => [$this, 'block_tntsearch_input'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["url"] = (((isset($context["url"]) || array_key_exists("url", $context))) ? (_twig_default_filter(($context["url"] ?? null), (($this->env->getExtension('Grav\Common\Twig\TwigExtension')->rtrimFilter(($context["base_url"] ?? null), "/") . "/") . twig_trim_filter($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.query_route", 1 => "s"], "method"), "/")))) : ((($this->env->getExtension('Grav\Common\Twig\TwigExtension')->rtrimFilter(($context["base_url"] ?? null), "/") . "/") . twig_trim_filter($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.query_route", 1 => "s"], "method"), "/"))));
        // line 2
        $context["limit"] = (((isset($context["limit"]) || array_key_exists("limit", $context))) ? (_twig_default_filter(($context["limit"] ?? null), $this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.limit", 1 => 20], "method"))) : ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.limit", 1 => 20], "method")));
        // line 3
        $context["snippet"] = (((isset($context["snippet"]) || array_key_exists("snippet", $context))) ? (_twig_default_filter(($context["snippet"] ?? null), $this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.snippet", 1 => 300], "method"))) : ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.snippet", 1 => 300], "method")));
        // line 4
        $context["min"] = (((isset($context["min"]) || array_key_exists("min", $context))) ? (_twig_default_filter(($context["min"] ?? null), $this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.min", 1 => 3], "method"))) : ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.min", 1 => 3], "method")));
        // line 5
        $context["search_type"] = (((isset($context["search_type"]) || array_key_exists("search_type", $context))) ? (_twig_default_filter(($context["search_type"] ?? null), $this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.search_type", 1 => "auto"], "method"))) : ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.search_type", 1 => "auto"], "method")));
        // line 6
        $context["placeholder"] = (((isset($context["placeholder"]) || array_key_exists("placeholder", $context))) ? (_twig_default_filter(($context["placeholder"] ?? null), "Search...")) : ("Search..."));
        // line 7
        $context["live_update"] = ((($context["in_page"] ?? null)) ? ((((isset($context["live_update"]) || array_key_exists("live_update", $context))) ? (_twig_default_filter(($context["live_update"] ?? null), $this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.live_uri_update", 1 => 1], "method"))) : ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.live_uri_update", 1 => 1], "method")))) : (0));
        // line 8
        $context["nojs_action"] = twig_trim_filter($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.search_route", 1 => "/search"], "method"), "/");
        // line 9
        echo "
";
        // line 10
        $context["options"] = ["uri" => ($context["url"] ?? null), "limit" => ($context["limit"] ?? null), "snippet" => ($context["snippet"] ?? null), "min" => ($context["min"] ?? null), "in_page" => ($context["in_page"] ?? null), "live_update" => ($context["live_update"] ?? null), "search_type" => ($context["search_type"] ?? null)];
        // line 11
        echo "
<form role=\"form\" class=\"tntsearch-form\" action=\"";
        // line 12
        echo ($context["nojs_action"] ?? null);
        echo "\" method=\"get\">
    ";
        // line 13
        $this->displayBlock('tntsearch_input', $context, $blocks);
        // line 19
        echo "    <div class=\"tntsearch-results";
        echo ((($context["in_page"] ?? null)) ? (" tntsearch-results-inpage") : (""));
        echo "\">
    ";
        // line 20
        if ((((isset($context["tntsearch_results"]) || array_key_exists("tntsearch_results", $context)) &&  !twig_test_empty(($context["tntsearch_results"] ?? null))) && ($context["in_page"] ?? null))) {
            // line 21
            echo "        ";
            $this->loadTemplate("tntquery-ajax.html.twig", "partials/tntsearch.html.twig", 21)->display($context);
            // line 22
            echo "    ";
        }
        // line 23
        echo "    </div>

    ";
        // line 25
        if ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.powered_by"], "method")) {
            // line 26
            echo "    <p class=\"tntsearch-powered-by\">
        ";
            // line 27
            echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, "PLUGIN_TNTSEARCH.POWERED_BY", "<a href='https://github.com/trilbymedia/grav-plugin-tntsearch' target='_blank'>TNTSearch</a>");
            echo "
    </p>
    ";
        }
        // line 30
        echo "</form>
";
    }

    // line 13
    public function block_tntsearch_input($context, array $blocks = [])
    {
        // line 14
        echo "    <div id=\"tntsearch-wrapper\" class=\"form-group";
        echo ((($context["dropdown"] ?? null)) ? (" tntsearch-dropdown") : (""));
        echo "\">
        <input type=\"text\" name=\"q\" class=\"form-control form-input tntsearch-field";
        // line 15
        echo ((($context["in_page"] ?? null)) ? (" tntsearch-field-inpage") : (""));
        echo "\" data-tntsearch=\"";
        echo twig_escape_filter($this->env, twig_jsonencode_filter(($context["options"] ?? null)), "html_attr");
        echo "\" placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" value=\"";
        echo (( !($context["dropdown"] ?? null)) ? (twig_escape_filter($this->env, ($context["query"] ?? null))) : (""));
        echo "\" autofocus>
        <span class=\"tntsearch-clear\"";
        // line 16
        echo ((( !($context["query"] ?? null) || ($context["dropdown"] ?? null))) ? (" style=\"display: none;\"") : (""));
        echo ">&times;</span>
    </div>
    ";
    }

    public function getTemplateName()
    {
        return "partials/tntsearch.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 16,  102 => 15,  97 => 14,  94 => 13,  89 => 30,  83 => 27,  80 => 26,  78 => 25,  74 => 23,  71 => 22,  68 => 21,  66 => 20,  61 => 19,  59 => 13,  55 => 12,  52 => 11,  50 => 10,  47 => 9,  45 => 8,  43 => 7,  41 => 6,  39 => 5,  37 => 4,  35 => 3,  33 => 2,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set url = url|default(base_url|rtrim('/') ~ '/' ~ config.get('plugins.tntsearch.query_route', 's')|trim('/')) %}
{% set limit = limit|default(config.get('plugins.tntsearch.limit', 20)) %}
{% set snippet = snippet|default(config.get('plugins.tntsearch.snippet', 300)) %}
{% set min = min|default(config.get('plugins.tntsearch.min', 3)) %}
{% set search_type = search_type|default(config.get('plugins.tntsearch.search_type', 'auto')) %}
{% set placeholder = placeholder|default('Search...') %}
{% set live_update = in_page ? live_update|default(config.get('plugins.tntsearch.live_uri_update', 1)) : 0 %}
{% set nojs_action = config.get('plugins.tntsearch.search_route', '/search')|trim('/') %}

{% set options = { uri: url, limit: limit, snippet: snippet, min: min, in_page: in_page, live_update: live_update, search_type: search_type } %}

<form role=\"form\" class=\"tntsearch-form\" action=\"{{ nojs_action }}\" method=\"get\">
    {% block tntsearch_input %}
    <div id=\"tntsearch-wrapper\" class=\"form-group{{ dropdown ? ' tntsearch-dropdown' : '' }}\">
        <input type=\"text\" name=\"q\" class=\"form-control form-input tntsearch-field{{ in_page ? ' tntsearch-field-inpage' : '' }}\" data-tntsearch=\"{{ options|json_encode|e('html_attr') }}\" placeholder=\"{{ placeholder }}\" value=\"{{ not dropdown ? query|e : '' }}\" autofocus>
        <span class=\"tntsearch-clear\"{{ not query or dropdown ? ' style=\"display: none;\"' : '' }}>&times;</span>
    </div>
    {% endblock %}
    <div class=\"tntsearch-results{{ in_page ? ' tntsearch-results-inpage' : '' }}\">
    {% if tntsearch_results is defined and tntsearch_results is not empty and in_page %}
        {% include 'tntquery-ajax.html.twig' %}
    {% endif %}
    </div>

    {% if config.get('plugins.tntsearch.powered_by') %}
    <p class=\"tntsearch-powered-by\">
        {{ \"PLUGIN_TNTSEARCH.POWERED_BY\"|t(\"<a href='https://github.com/trilbymedia/grav-plugin-tntsearch' target='_blank'>TNTSearch</a>\")|raw }}
    </p>
    {% endif %}
</form>
", "partials/tntsearch.html.twig", "/var/www/html/user/plugins/tntsearch/templates/partials/tntsearch.html.twig");
    }
}
