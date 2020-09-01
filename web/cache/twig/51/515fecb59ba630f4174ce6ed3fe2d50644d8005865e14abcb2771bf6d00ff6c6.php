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

/* forms/layouts/field.html.twig */
class __TwigTemplate_88965eb118cff7ea6e29c09fd965d51db6fe3938858f53f4a9cd2799e6157ef6 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'field' => [$this, 'block_field'],
            'contents' => [$this, 'block_contents'],
            'label' => [$this, 'block_label'],
            'global_attributes' => [$this, 'block_global_attributes'],
            'group' => [$this, 'block_group'],
            'input' => [$this, 'block_input'],
            'prepend' => [$this, 'block_prepend'],
            'input_attributes' => [$this, 'block_input_attributes'],
            'append' => [$this, 'block_append'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->displayBlock('field', $context, $blocks);
    }

    public function block_field($context, array $blocks = [])
    {
        // line 2
        echo "<div class=\"form-field ";
        echo twig_trim_filter(($context["layout_form_field_outer_classes"] ?? null));
        echo twig_trim_filter(($context["form_field_outer_core"] ?? null));
        echo "\">
  ";
        // line 3
        $this->displayBlock('contents', $context, $blocks);
        // line 51
        echo "</div>
";
    }

    // line 3
    public function block_contents($context, array $blocks = [])
    {
        // line 4
        echo "    ";
        if (($context["show_label"] ?? null)) {
            // line 5
            echo "      <div class=\"";
            echo ($context["layout_form_field_outer_label_classes"] ?? null);
            echo "\">";
            // line 6
            echo ($context["form_field_toggleable"] ?? null);
            // line 7
            echo "<label class=\"";
            echo ($context["layout_form_field_label_classes"] ?? null);
            echo ($context["form_field_label_trim"] ?? null);
            echo "\" ";
            if ($this->getAttribute(($context["field"] ?? null), "id", [])) {
                echo "for=\"";
                echo ($context["form_field_for"] ?? null);
                echo "\"";
            }
            echo ">";
            // line 8
            $this->displayBlock('label', $context, $blocks);
            // line 18
            echo "</label>
      </div>
    ";
        }
        // line 21
        echo "    <div class=\"";
        echo ($context["layout_form_field_outer_data_classes"] ?? null);
        echo "\"
        ";
        // line 22
        $this->displayBlock('global_attributes', $context, $blocks);
        // line 23
        echo "    >
      ";
        // line 24
        $this->displayBlock('group', $context, $blocks);
        // line 42
        echo "      ";
        if ($this->getAttribute(($context["field"] ?? null), "description", [], "any", true, true)) {
            // line 43
            echo "        <div class=\"";
            echo ($context["form_field_extra_wrapper_classes"] ?? null);
            echo "\">
          <span class=\"form-description\">
            ";
            // line 45
            echo ($context["form_field_description"] ?? null);
            echo "
          </span>
        </div>
      ";
        }
        // line 49
        echo "    </div>
  ";
    }

    // line 8
    public function block_label($context, array $blocks = [])
    {
        // line 9
        if (($context["form_field_help"] ?? null)) {
            // line 10
            echo "<span class=\"tooltip\" data-tooltip=\"";
            echo twig_escape_filter($this->env, ($context["form_field_help"] ?? null));
            echo "\">";
            echo ($context["form_field_label"] ?? null);
            echo "</span>";
        } else {
            // line 12
            echo ($context["form_field_label"] ?? null);
        }
        // line 14
        if (($context["form_field_required"] ?? null)) {
            // line 15
            echo "              <span class=\"required\">*</span>";
        }
    }

    // line 22
    public function block_global_attributes($context, array $blocks = [])
    {
    }

    // line 24
    public function block_group($context, array $blocks = [])
    {
        // line 25
        echo "        ";
        $this->displayBlock('input', $context, $blocks);
        // line 41
        echo "      ";
    }

    // line 25
    public function block_input($context, array $blocks = [])
    {
        // line 26
        echo "          <div class=\"";
        echo ($context["layout_form_field_wrapper_classes"] ?? null);
        echo " ";
        echo $this->getAttribute(($context["field"] ?? null), "size", []);
        echo "\">
            ";
        // line 27
        $this->displayBlock('prepend', $context, $blocks);
        // line 28
        echo "            <input
              name=\"";
        // line 29
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . $this->getAttribute(($context["field"] ?? null), "name", [])));
        echo "\"
              value=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_join_filter(($context["value"] ?? null), ", "));
        echo "\"
              ";
        // line 31
        $this->displayBlock('input_attributes', $context, $blocks);
        // line 32
        echo "            />
            ";
        // line 33
        $this->displayBlock('append', $context, $blocks);
        // line 34
        echo "            ";
        if ((($context["inline_errors"] ?? null) && ($context["errors"] ?? null))) {
            // line 35
            echo "            <div class=\"";
            echo ($context["form_field_inline_error_classes"] ?? null);
            echo "\">
              <p class=\"form-message\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 36
            echo twig_first($this->env, ($context["errors"] ?? null));
            echo "</p>
            </div>
            ";
        }
        // line 39
        echo "          </div>
        ";
    }

    // line 27
    public function block_prepend($context, array $blocks = [])
    {
    }

    // line 31
    public function block_input_attributes($context, array $blocks = [])
    {
    }

    // line 33
    public function block_append($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "forms/layouts/field.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  217 => 33,  212 => 31,  207 => 27,  202 => 39,  196 => 36,  191 => 35,  188 => 34,  186 => 33,  183 => 32,  181 => 31,  177 => 30,  173 => 29,  170 => 28,  168 => 27,  161 => 26,  158 => 25,  154 => 41,  151 => 25,  148 => 24,  143 => 22,  138 => 15,  136 => 14,  133 => 12,  126 => 10,  124 => 9,  121 => 8,  116 => 49,  109 => 45,  103 => 43,  100 => 42,  98 => 24,  95 => 23,  93 => 22,  88 => 21,  83 => 18,  81 => 8,  70 => 7,  68 => 6,  64 => 5,  61 => 4,  58 => 3,  53 => 51,  51 => 3,  45 => 2,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% block field %}
<div class=\"form-field {{ layout_form_field_outer_classes|trim -}} {{- form_field_outer_core|trim -}}\">
  {% block contents %}
    {% if show_label %}
      <div class=\"{{- layout_form_field_outer_label_classes -}}\">
        {{- form_field_toggleable -}}
        <label class=\"{{ layout_form_field_label_classes }}{{ form_field_label_trim }}\" {% if field.id %}for=\"{{ form_field_for }}\"{% endif %}>
          {%- block label -%}
            {%- if form_field_help -%}
              <span class=\"tooltip\" data-tooltip=\"{{ form_field_help|e }}\">{{ form_field_label|raw }}</span>
            {%- else -%}
              {{ form_field_label|raw }}
            {%- endif -%}
            {%- if form_field_required %}
              <span class=\"required\">*</span>
            {%- endif -%}
          {%- endblock -%}
        </label>
      </div>
    {% endif %}
    <div class=\"{{ layout_form_field_outer_data_classes }}\"
        {% block global_attributes %}{% endblock %}
    >
      {% block group %}
        {% block input %}
          <div class=\"{{ layout_form_field_wrapper_classes }} {{ field.size }}\">
            {% block prepend %}{% endblock prepend %}
            <input
              name=\"{{ (scope ~ field.name)|fieldName }}\"
              value=\"{{ value|join(', ')|e }}\"
              {% block input_attributes %}{% endblock %}
            />
            {% block append %}{% endblock append %}
            {% if inline_errors and errors %}
            <div class=\"{{ form_field_inline_error_classes }}\">
              <p class=\"form-message\"><i class=\"fa fa-exclamation-circle\"></i> {{ errors|first|raw }}</p>
            </div>
            {% endif %}
          </div>
        {% endblock %}
      {% endblock %}
      {% if field.description is defined %}
        <div class=\"{{ form_field_extra_wrapper_classes }}\">
          <span class=\"form-description\">
            {{ form_field_description|raw }}
          </span>
        </div>
      {% endif %}
    </div>
  {% endblock %}
</div>
{% endblock %}
", "forms/layouts/field.html.twig", "/var/www/html/user/plugins/form/templates/forms/layouts/field.html.twig");
    }
}
