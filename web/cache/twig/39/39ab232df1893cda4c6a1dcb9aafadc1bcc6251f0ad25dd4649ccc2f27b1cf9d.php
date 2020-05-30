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

/* tntquery-ajax.html.twig */
class __TwigTemplate_6599882e6d85987496faed8bae207ee4a9f267e4299956b3cad91b4ba2256b4e extends \Twig\Template
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
        echo "<div class=\"row\">
    <p class=\"info\">
        ";
        // line 3
        if ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.display_hits"], "method")) {
            // line 4
            echo "            <span class=\"hits\">";
            echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, "PLUGIN_TNTSEARCH.FOUND_RESULTS", $this->getAttribute(($context["tntsearch_results"] ?? null), "number_of_hits", []));
            echo "</span>
        ";
        }
        // line 6
        echo "        ";
        if ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.display_time"], "method")) {
            // line 7
            echo "            <span class=\"time\">";
            echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, "PLUGIN_TNTSEARCH.FOUND_IN", $this->getAttribute(($context["tntsearch_results"] ?? null), "execution_time", []));
            echo "</span>
        ";
        }
        // line 9
        echo "    </p>
    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["tntsearch_results"] ?? null), "hits", []));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 11
            echo "        <h5 class=\"title\">
            <a href=\"";
            // line 12
            echo (($context["base_url"] ?? null) . $this->getAttribute($context["val"], "link", []));
            echo "\">";
            echo $this->getAttribute($context["val"], "title", []);
            echo "</a>
        </h5>
        ";
            // line 14
            if ($this->getAttribute(($context["config"] ?? null), "get", [0 => "plugins.tntsearch.display_route"], "method")) {
                // line 15
                echo "            <h6 class=\"route\">";
                echo $this->getAttribute($context["val"], "link", []);
                echo "</h6>
        ";
            }
            // line 17
            echo "        <p>";
            echo $this->getAttribute($context["val"], "content", []);
            echo "</p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "tntquery-ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 19,  76 => 17,  70 => 15,  68 => 14,  61 => 12,  58 => 11,  54 => 10,  51 => 9,  45 => 7,  42 => 6,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"row\">
    <p class=\"info\">
        {% if config.get('plugins.tntsearch.display_hits') %}
            <span class=\"hits\">{{ \"PLUGIN_TNTSEARCH.FOUND_RESULTS\"|t(tntsearch_results.number_of_hits)|raw }}</span>
        {% endif %}
        {% if config.get('plugins.tntsearch.display_time') %}
            <span class=\"time\">{{ \"PLUGIN_TNTSEARCH.FOUND_IN\"|t(tntsearch_results.execution_time)|raw }}</span>
        {% endif %}
    </p>
    {% for key, val in tntsearch_results.hits  %}
        <h5 class=\"title\">
            <a href=\"{{ base_url ~ val.link }}\">{{ val.title|raw }}</a>
        </h5>
        {% if config.get('plugins.tntsearch.display_route') %}
            <h6 class=\"route\">{{ val.link|raw }}</h6>
        {% endif %}
        <p>{{ val.content|raw }}</p>
    {% endfor %}
</div>", "tntquery-ajax.html.twig", "/var/www/html/user/plugins/tntsearch/templates/tntquery-ajax.html.twig");
    }
}
