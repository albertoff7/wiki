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

/* macros/macros.html.twig */
class __TwigTemplate_ffd2e9695660250b70bd503f2771c6c810bfa36cea0f709a57c19bc91cc8904c extends \Twig\Template
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
        // line 24
        echo "
";
    }

    // line 1
    public function getloop($__page__ = null, $__parent_loop__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "page" => $__page__,
            "parent_loop" => $__parent_loop__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 2
            echo "  ";
            $context["macros"] = $this;
            // line 3
            echo "  ";
            if ((twig_length_filter($this->env, ($context["parent_loop"] ?? null)) > 0)) {
                // line 4
                echo "    ";
                $context["data_level"] = ($context["parent_loop"] ?? null);
                // line 5
                echo "  ";
            } else {
                // line 6
                echo "    ";
                $context["data_level"] = 0;
                // line 7
                echo "  ";
            }
            // line 8
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["page"] ?? null), "children", []), "visible", []));
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
            foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                // line 9
                echo "    ";
                $context["parent_page"] = (($this->getAttribute($context["p"], "activeChild", [])) ? (" parent") : (""));
                // line 10
                echo "    ";
                $context["current_page"] = (($this->getAttribute($context["p"], "active", [])) ? (" active") : (""));
                // line 11
                echo "    <li class=\"dd-item";
                echo ($context["parent_page"] ?? null);
                echo ($context["current_page"] ?? null);
                echo "\" data-nav-id=\"";
                echo $this->getAttribute($context["p"], "route", []);
                echo "\">
      <a href=\"";
                // line 12
                echo $this->getAttribute($context["p"], "url", []);
                echo "\" ";
                if ($this->getAttribute($this->getAttribute($context["p"], "header", []), "class", [])) {
                    echo "class=\"";
                    echo $this->getAttribute($this->getAttribute($context["p"], "header", []), "class", []);
                    echo "\"";
                }
                echo ">
        <i class=\"fa fa-check-square read-icon\"></i>
        <span><b>";
                // line 14
                if ((($context["data_level"] ?? null) == 0)) {
                    echo $this->getAttribute($context["loop"], "index", []);
                    echo ". ";
                }
                echo "</b>";
                echo $this->getAttribute($context["p"], "menu", []);
                echo "</span>
      </a>
      ";
                // line 16
                if (($this->getAttribute($this->getAttribute($context["p"], "children", []), "count", []) > 0)) {
                    // line 17
                    echo "        <ul>
          ";
                    // line 18
                    echo $context["macros"]->getloop($context["p"], ((((isset($context["parent_loop"]) || array_key_exists("parent_loop", $context))) ? (_twig_default_filter(($context["parent_loop"] ?? null), 0)) : (0)) + $this->getAttribute($context["loop"], "index", [])));
                    echo "
        </ul>
      ";
                }
                // line 21
                echo "    </li>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 25
    public function getversion($__p__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "p" => $__p__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 26
            echo "  ";
            $context["parent_page"] = (($this->getAttribute(($context["p"] ?? null), "activeChild", [])) ? (" parent") : (""));
            // line 27
            echo "  ";
            $context["current_page"] = (($this->getAttribute(($context["p"] ?? null), "active", [])) ? (" active") : (""));
            // line 28
            echo "  <h5 class=\"";
            echo ($context["parent_page"] ?? null);
            echo ($context["current_page"] ?? null);
            echo "\">
    ";
            // line 29
            if (($this->getAttribute(($context["p"] ?? null), "activeChild", []) || $this->getAttribute(($context["p"] ?? null), "active", []))) {
                // line 30
                echo "      <i class=\"fa fa-chevron-down fa-fw\"></i>
    ";
            } else {
                // line 32
                echo "      <i class=\"fa fa-plus fa-fw\"></i>
    ";
            }
            // line 34
            echo "    <a href=\"";
            echo $this->getAttribute(($context["p"] ?? null), "url", []);
            echo "\">";
            echo $this->getAttribute(($context["p"] ?? null), "menu", []);
            echo "</a>
  </h5>
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "macros/macros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 34,  188 => 32,  184 => 30,  182 => 29,  176 => 28,  173 => 27,  170 => 26,  158 => 25,  130 => 21,  124 => 18,  121 => 17,  119 => 16,  109 => 14,  98 => 12,  90 => 11,  87 => 10,  84 => 9,  66 => 8,  63 => 7,  60 => 6,  57 => 5,  54 => 4,  51 => 3,  48 => 2,  35 => 1,  30 => 24,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% macro loop(page, parent_loop) %}
  {% import _self as macros %}
  {% if parent_loop|length > 0 %}
    {% set data_level = parent_loop %}
  {% else %}
    {% set data_level = 0 %}
  {% endif %}
  {% for p in page.children.visible %}
    {% set parent_page = p.activeChild ? ' parent' : '' %}
    {% set current_page = p.active ? ' active' : '' %}
    <li class=\"dd-item{{ parent_page }}{{ current_page }}\" data-nav-id=\"{{ p.route }}\">
      <a href=\"{{ p.url }}\" {% if p.header.class %}class=\"{{ p.header.class }}\"{% endif %}>
        <i class=\"fa fa-check-square read-icon\"></i>
        <span><b>{% if data_level == 0 %}{{ loop.index }}. {% endif %}</b>{{ p.menu }}</span>
      </a>
      {% if p.children.count > 0 %}
        <ul>
          {{ macros.loop(p, parent_loop|default(0)+loop.index) }}
        </ul>
      {% endif %}
    </li>
  {% endfor %}
{% endmacro %}

{% macro version(p) %}
  {% set parent_page = p.activeChild ? ' parent' : '' %}
  {% set current_page = p.active ? ' active' : '' %}
  <h5 class=\"{{ parent_page }}{{ current_page }}\">
    {% if p.activeChild or p.active %}
      <i class=\"fa fa-chevron-down fa-fw\"></i>
    {% else %}
      <i class=\"fa fa-plus fa-fw\"></i>
    {% endif %}
    <a href=\"{{ p.url }}\">{{ p.menu }}</a>
  </h5>
{% endmacro %}", "macros/macros.html.twig", "/var/www/html/user/themes/learn4/templates/macros/macros.html.twig");
    }
}
