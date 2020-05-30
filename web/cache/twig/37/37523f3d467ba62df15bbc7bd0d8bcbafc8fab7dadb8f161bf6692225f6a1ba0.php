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

/* forms/fields/toggle/toggle.html.twig */
class __TwigTemplate_40c9e533e2e030d5348dec226d990706571eb9aa595ec8f6652f2883690b8e55 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'global_attributes' => [$this, 'block_global_attributes'],
            'input' => [$this, 'block_input'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "forms/field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 8
        $context["macro"] = $this;
        // line 10
        $context["has_hidden"] = false;
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", []));
        foreach ($context['_seq'] as $context["key"] => $context["text"]) {
            // line 12
            if (twig_test_empty($context["key"])) {
                // line 13
                $context["has_hidden"] = true;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1
        $this->parent = $this->loadTemplate("forms/field.html.twig", "forms/fields/toggle/toggle.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 17
    public function block_global_attributes($context, array $blocks = [])
    {
        // line 18
        echo "  ";
        $this->displayParentBlock("global_attributes", $context, $blocks);
        echo "
  data-grav-field-name=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . $this->getAttribute(($context["field"] ?? null), "name", []))), "html", null, true);
        echo "\"
";
    }

    // line 22
    public function block_input($context, array $blocks = [])
    {
        // line 23
        echo "    ";
        $context["value"] = (((($context["value"] ?? null) === false)) ? (0) : (($context["value"] ?? null)));
        // line 24
        echo "
    ";
        // line 25
        if (($this->getAttribute(($context["field"] ?? null), "force_bool", []) && ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->getTypeFunc(($context["value"] ?? null)) == "string"))) {
            // line 26
            echo "        ";
            $context["value"] = true;
            // line 27
            echo "    ";
        }
        // line 28
        echo "

  <div class=\"switch-toggle switch-grav ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "size", []), "html", null, true);
        echo " switch-";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute(($context["field"] ?? null), "options", [])), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "classes", []), "html", null, true);
        echo "\">
    ";
        // line 31
        $context["maxLen"] = 0;
        // line 32
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", []));
        foreach ($context['_seq'] as $context["_key"] => $context["text"]) {
            // line 33
            echo "      ";
            $context["translation"] = twig_trim_filter($this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $context["text"]));
            // line 34
            echo "      ";
            $context["maxLen"] = max(twig_length_filter($this->env, ($context["translation"] ?? null)), ($context["maxLen"] ?? null));
            // line 35
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "
    ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", []));
        foreach ($context['_seq'] as $context["key"] => $context["text"]) {
            // line 38
            echo "      ";
            $context["id"] = (("toggle_" . $this->getAttribute(($context["field"] ?? null), "name", [])) . $context["key"]);
            // line 39
            echo "      ";
            $context["translation"] = twig_trim_filter($this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $context["text"]));
            // line 40
            echo "
      <input type=\"radio\"
             value=\"";
            // line 42
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\"
             id=\"";
            // line 43
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\"
             name=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . $this->getAttribute(($context["field"] ?? null), "name", []))), "html", null, true);
            echo "\"
          ";
            // line 45
            if ($this->getAttribute(($context["field"] ?? null), "highlight", [], "any", true, true)) {
                // line 46
                echo "            class=\"";
                echo ((($this->getAttribute(($context["field"] ?? null), "highlight", []) == ("" . $context["key"]))) ? ("highlight") : (""));
                echo "\"
          ";
            }
            // line 48
            echo "          ";
            if (($this->getAttribute(($context["field"] ?? null), "disabled", []) || ($context["isDisabledToggleable"] ?? null))) {
                echo "disabled=\"disabled\"";
            }
            // line 49
            echo "          ";
            if ($this->getAttribute(($context["field"] ?? null), "toggleable", [])) {
                // line 50
                echo "            ";
                if ((("" . $context["key"]) == ("" . ($context["value"] ?? null)))) {
                    // line 51
                    echo "              checked=\"checked\"
            ";
                } elseif ((                // line 52
(isset($context["value"]) || array_key_exists("value", $context)) && (($context["key"] == 1) || ($context["key"] == "1")))) {
                    // line 53
                    echo "              checked=\"checked\"
            ";
                }
                // line 55
                echo "          ";
            } else {
                // line 56
                echo "            ";
                if ((("" . $context["key"]) == ("" . ($context["value"] ?? null)))) {
                    // line 57
                    echo "              checked=\"checked\"
            ";
                }
                // line 59
                echo "          ";
            }
            // line 60
            echo "          ";
            if (twig_in_filter($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "required", []), [0 => "on", 1 => "true", 2 => 1])) {
                echo "required=\"required\"";
            }
            // line 61
            echo "          ";
            if ($this->getAttribute(($context["field"] ?? null), "tabindex", [])) {
                echo "tabindex=\"";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "tabindex", []), "html", null, true);
                echo "\"";
            }
            // line 62
            echo "      />
      <label for=\"";
            // line 63
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\">";
            echo twig_trim_filter($context["macro"]->getspanToggle(($context["translation"] ?? null), ($context["maxLen"] ?? null)));
            echo "</label>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "  </div>
";
    }

    // line 3
    public function getspanToggle($__input__ = null, $__length__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "input" => $__input__,
            "length" => $__length__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 4
            echo "  ";
            $context["space"] = $this->env->getExtension('Grav\Common\Twig\TwigExtension')->repeatFunc("&nbsp;&nbsp;", ((($context["length"] ?? null) - twig_length_filter($this->env, ($context["input"] ?? null))) / 2));
            // line 5
            echo "  ";
            echo ((($context["space"] ?? null) . ($context["input"] ?? null)) . ($context["space"] ?? null));
            echo "
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
        return "forms/fields/toggle/toggle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  236 => 5,  233 => 4,  220 => 3,  215 => 65,  205 => 63,  202 => 62,  195 => 61,  190 => 60,  187 => 59,  183 => 57,  180 => 56,  177 => 55,  173 => 53,  171 => 52,  168 => 51,  165 => 50,  162 => 49,  157 => 48,  151 => 46,  149 => 45,  145 => 44,  141 => 43,  137 => 42,  133 => 40,  130 => 39,  127 => 38,  123 => 37,  120 => 36,  114 => 35,  111 => 34,  108 => 33,  103 => 32,  101 => 31,  93 => 30,  89 => 28,  86 => 27,  83 => 26,  81 => 25,  78 => 24,  75 => 23,  72 => 22,  66 => 19,  61 => 18,  58 => 17,  53 => 1,  46 => 13,  44 => 12,  40 => 11,  38 => 10,  36 => 8,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"forms/field.html.twig\" %}

{% macro spanToggle(input, length) %}
  {% set space = repeat('&nbsp;&nbsp;', (length - input|length) / 2) %}
  {{ (space ~ input ~ space)|raw }}
{% endmacro %}

{% import _self as macro %}

{% set has_hidden = false %}
{% for key, text in field.options %}
  {% if key is empty %}
    {% set has_hidden = true %}
  {% endif %}
{% endfor %}

{% block global_attributes %}
  {{ parent() }}
  data-grav-field-name=\"{{ (scope ~ field.name)|fieldName }}\"
{% endblock %}

{% block input %}
    {% set value = (value is same as(false) ? 0 : value) %}

    {% if field.force_bool and get_type(value) == 'string'%}
        {% set value = true %}
    {% endif %}


  <div class=\"switch-toggle switch-grav {{ field.size }} switch-{{ field.options|length }} {{ field.classes }}\">
    {% set maxLen = 0 %}
    {% for text in field.options %}
      {% set translation = text|t|trim %}
      {% set maxLen = max(translation|length, maxLen) %}
    {% endfor %}

    {% for key, text in field.options %}
      {% set id = \"toggle_\" ~ field.name ~ key %}
      {% set translation = text|t|trim %}

      <input type=\"radio\"
             value=\"{{ key }}\"
             id=\"{{ id }}\"
             name=\"{{ (scope ~ field.name)|fieldName }}\"
          {% if field.highlight is defined %}
            class=\"{{ field.highlight == '' ~ key ? 'highlight' : '' }}\"
          {% endif %}
          {% if field.disabled or isDisabledToggleable %}disabled=\"disabled\"{% endif %}
          {% if field.toggleable %}
            {% if '' ~ key == '' ~ value %}
              checked=\"checked\"
            {% elseif value is defined and (key == 1 or key == '1') %}
              checked=\"checked\"
            {% endif %}
          {% else %}
            {% if '' ~ key == '' ~ value %}
              checked=\"checked\"
            {% endif %}
          {% endif %}
          {% if field.validate.required in ['on', 'true', 1] %}required=\"required\"{% endif %}
          {% if field.tabindex %}tabindex=\"{{ field.tabindex }}\"{% endif %}
      />
      <label for=\"{{ id }}\">{{ (macro.spanToggle(translation, maxLen)|trim)|raw }}</label>
    {% endfor %}
  </div>
{% endblock %}
", "forms/fields/toggle/toggle.html.twig", "/var/www/html/user/plugins/form/templates/forms/fields/toggle/toggle.html.twig");
    }
}
