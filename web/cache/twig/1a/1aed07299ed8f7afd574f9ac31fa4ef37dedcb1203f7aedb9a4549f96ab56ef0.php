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

/* partials/breadcrumbs.html.twig */
class __TwigTemplate_f561ab640842e428004aea4d45b8538383e4b7033aff7d313d69c5c1811134aa extends \Twig\Template
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
        $context["crumbs"] = $this->getAttribute(($context["breadcrumbs"] ?? null), "get", [], "method");
        // line 2
        $context["breadcrumbs_config"] = $this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "breadcrumbs", []);
        // line 3
        $context["divider"] = $this->getAttribute(($context["breadcrumbs_config"] ?? null), "icon_divider_classes", []);
        // line 4
        echo "
";
        // line 5
        if (((twig_length_filter($this->env, ($context["crumbs"] ?? null)) > 1) || $this->getAttribute(($context["breadcrumbs_config"] ?? null), "show_all", []))) {
            // line 6
            echo "<div id=\"breadcrumbs\" itemscope itemtype=\"http://schema.org/BreadcrumbList\">
    ";
            // line 7
            if ($this->getAttribute(($context["breadcrumbs_config"] ?? null), "icon_home", [])) {
                // line 8
                echo "    <i class=\"";
                echo $this->getAttribute(($context["breadcrumbs_config"] ?? null), "icon_home", []);
                echo "\"></i>
    ";
            }
            // line 10
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["crumbs"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["crumb"]) {
                // line 11
                echo "    <span itemprop=\"itemListElement\" itemscope itemtype=\"http://schema.org/ListItem\">
        ";
                // line 12
                if ( !$this->getAttribute($context["loop"], "last", [])) {
                    // line 13
                    echo "            ";
                    if ($this->getAttribute($context["crumb"], "routable", [])) {
                        // line 14
                        echo "                <a itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" href=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\" itemid=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\">
                    <span itemprop=\"name\">";
                        // line 15
                        echo $this->getAttribute($context["crumb"], "menu", []);
                        echo "</span>
                </a>
            ";
                    } else {
                        // line 18
                        echo "                <span itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" itemid=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\">
                    <span itemprop=\"name\">";
                        // line 19
                        echo $this->getAttribute($context["crumb"], "menu", []);
                        echo "</span>
                </span>
            ";
                    }
                    // line 22
                    echo "            <i class=\"";
                    echo ($context["divider"] ?? null);
                    echo "\"></i>
        ";
                } else {
                    // line 24
                    echo "            ";
                    if ($this->getAttribute(($context["breadcrumbs_config"] ?? null), "link_trailing", [])) {
                        // line 25
                        echo "                <a itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" href=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\" itemid=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\">
                    <span itemprop=\"name\">";
                        // line 26
                        echo $this->getAttribute($context["crumb"], "menu", []);
                        echo "</span>
                </a>
            ";
                    } else {
                        // line 29
                        echo "                <span itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" itemid=\"";
                        echo $this->getAttribute($context["crumb"], "url", []);
                        echo "\">
                    <span itemprop=\"name\">";
                        // line 30
                        echo $this->getAttribute($context["crumb"], "menu", []);
                        echo "</span>
                </span>
            ";
                    }
                    // line 33
                    echo "        ";
                }
                // line 34
                echo "        <meta itemprop=\"position\" content=\"";
                echo $this->getAttribute($context["loop"], "index", []);
                echo "\" />
    </span>
    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['crumb'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "partials/breadcrumbs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 37,  138 => 34,  135 => 33,  129 => 30,  124 => 29,  118 => 26,  111 => 25,  108 => 24,  102 => 22,  96 => 19,  91 => 18,  85 => 15,  78 => 14,  75 => 13,  73 => 12,  70 => 11,  52 => 10,  46 => 8,  44 => 7,  41 => 6,  39 => 5,  36 => 4,  34 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set crumbs = breadcrumbs.get() %}
{% set breadcrumbs_config = config.plugins.breadcrumbs %}
{% set divider = breadcrumbs_config.icon_divider_classes %}

{% if crumbs|length > 1 or breadcrumbs_config.show_all %}
<div id=\"breadcrumbs\" itemscope itemtype=\"http://schema.org/BreadcrumbList\">
    {% if breadcrumbs_config.icon_home %}
    <i class=\"{{ breadcrumbs_config.icon_home }}\"></i>
    {% endif %}
    {% for crumb in crumbs %}
    <span itemprop=\"itemListElement\" itemscope itemtype=\"http://schema.org/ListItem\">
        {% if not loop.last %}
            {% if crumb.routable %}
                <a itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" href=\"{{ crumb.url }}\" itemid=\"{{ crumb.url }}\">
                    <span itemprop=\"name\">{{ crumb.menu }}</span>
                </a>
            {% else  %}
                <span itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" itemid=\"{{ crumb.url }}\">
                    <span itemprop=\"name\">{{ crumb.menu }}</span>
                </span>
            {% endif %}
            <i class=\"{{ divider }}\"></i>
        {% else %}
            {% if breadcrumbs_config.link_trailing %}
                <a itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" href=\"{{ crumb.url }}\" itemid=\"{{ crumb.url }}\">
                    <span itemprop=\"name\">{{ crumb.menu }}</span>
                </a>
            {% else %}
                <span itemscope itemtype=\"http://schema.org/Thing\" itemprop=\"item\" itemid=\"{{ crumb.url }}\">
                    <span itemprop=\"name\">{{ crumb.menu }}</span>
                </span>
            {% endif %}
        {% endif %}
        <meta itemprop=\"position\" content=\"{{ loop.index }}\" />
    </span>
    {% endfor %}
</div>
{% endif %}
", "partials/breadcrumbs.html.twig", "/var/www/html/user/plugins/breadcrumbs/templates/partials/breadcrumbs.html.twig");
    }
}
