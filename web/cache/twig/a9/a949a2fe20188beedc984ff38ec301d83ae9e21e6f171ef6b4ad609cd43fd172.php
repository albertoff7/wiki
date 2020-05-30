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

/* forms/default/field.html.twig */
class __TwigTemplate_60057c1c0fe444c9d68fb81a8ed2b96db03159d8537dc415781158a0b58f8e11 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $_trait_0 = $this->loadTemplate("forms/layouts/field-variables.html.twig", "forms/default/field.html.twig", 3);
        // line 3
        if (!$_trait_0->isTraitable()) {
            throw new RuntimeError('Template "'."forms/layouts/field-variables.html.twig".'" cannot be used as a trait.', 3, $this->getSourceContext());
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            [
                'field_override_variables_before' => [$this, 'block_field_override_variables_before'],
                'outer_field_classes' => [$this, 'block_outer_field_classes'],
                'global_attributes' => [$this, 'block_global_attributes'],
                'input_attributes' => [$this, 'block_input_attributes'],
            ]
        );
    }

    protected function doGetParent(array $context)
    {
        // line 107
        return "forms/layouts/field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ( !$this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "ignore", [])) {
            // line 6
            $context["field_name"] = $this->env->getExtension('Grav\Common\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . $this->getAttribute(($context["field"] ?? null), "name", [])));
            // line 7
            $context["vertical"] = ($this->getAttribute(($context["field"] ?? null), "style", []) == "vertical");
            // line 9
            if (( !($context["blueprints"] ?? null) || (((($this->getAttribute($this->getAttribute($this->getAttribute(($context["blueprints"] ?? null), "schema", [], "any", false, true), "type", [0 => $this->getAttribute(($context["field"] ?? null), "type", [])], "method", false, true), "input@", [], "array", true, true) &&  !(null === $this->getAttribute($this->getAttribute($this->getAttribute(($context["blueprints"] ?? null), "schema", [], "any", false, true), "type", [0 => $this->getAttribute(($context["field"] ?? null), "type", [])], "method", false, true), "input@", [], "array")))) ? ($this->getAttribute($this->getAttribute($this->getAttribute(($context["blueprints"] ?? null), "schema", [], "any", false, true), "type", [0 => $this->getAttribute(($context["field"] ?? null), "type", [])], "method", false, true), "input@", [], "array")) : (true)) === true))) {
                // line 10
                $context["toggleable"] = ((($this->getAttribute(($context["field"] ?? null), "toggleable", [], "any", true, true) &&  !(null === $this->getAttribute(($context["field"] ?? null), "toggleable", [])))) ? ($this->getAttribute(($context["field"] ?? null), "toggleable", [])) : (false));
                // line 11
                if (($context["toggleable"] ?? null)) {
                    // line 12
                    $context["originalValue"] = (((isset($context["originalValue"]) || array_key_exists("originalValue", $context))) ? (($context["originalValue"] ?? null)) : (($context["value"] ?? null)));
                    // line 13
                    $context["toggleableChecked"] =  !(null === ($context["originalValue"] ?? null));
                } elseif ($this->getAttribute(                // line 14
($context["field"] ?? null), "overridable", [])) {
                    // line 15
                    $context["toggleable"] = true;
                    // line 16
                    $context["default"] = ((($this->getAttribute(($context["form"] ?? null), "getDefaultValue", [0 => $this->getAttribute(($context["field"] ?? null), "name", [])], "method", true, true) &&  !(null === $this->getAttribute(($context["form"] ?? null), "getDefaultValue", [0 => $this->getAttribute(($context["field"] ?? null), "name", [])], "method")))) ? ($this->getAttribute(($context["form"] ?? null), "getDefaultValue", [0 => $this->getAttribute(($context["field"] ?? null), "name", [])], "method")) : ($this->getAttribute(($context["field"] ?? null), "default", [])));
                    // line 17
                    $context["toggleableChecked"] = ( !(null === ($context["value"] ?? null)) && (($context["value"] ?? null) != ($context["default"] ?? null)));
                }
                // line 20
                $context["cookie_name"] = ((("forms-" . $this->getAttribute(($context["form"] ?? null), "name", [])) . "-") . $this->getAttribute(($context["field"] ?? null), "name", []));
                // line 21
                $context["value"] = (($context["value"]) ?? ((( !(null === $this->env->getExtension('Grav\Common\Twig\TwigExtension')->getCookie(($context["cookie_name"] ?? null)))) ? ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->getCookie(($context["cookie_name"] ?? null))) : ($this->getAttribute(($context["field"] ?? null), "default", [])))));
                // line 23
                if ((($this->getAttribute(($context["field"] ?? null), "yaml", []) || ($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "type", []) == "yaml")) && twig_test_iterable(($context["value"] ?? null)))) {
                    // line 24
                    $context["value"] = call_user_func_array($this->env->getFilter('toYaml')->getCallable(), [($context["value"] ?? null)]);
                }
            } else {
                // line 27
                $context["toggleable"] = false;
            }
            // line 31
            $context["isDisabledToggleable"] = (($context["toggleable"] ?? null) &&  !($context["toggleableChecked"] ?? null));
            // line 33
            if (($context["toggleable"] ?? null)) {
                // line 34
                ob_start();
                // line 35
                echo "    ";
                $this->loadTemplate("forms/default/toggleable.html.twig", "forms/default/field.html.twig", 35)->display(twig_array_merge($context, ["checked" => ($context["toggleableChecked"] ?? null)]));
                // line 36
                echo "  ";
                $context["form_field_toggleable"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            }
            // line 39
            $context["errors"] = $this->getAttribute($this->getAttribute(($context["form"] ?? null), "messages", []), $this->getAttribute(($context["field"] ?? null), "name", []));
            // line 40
            $context["required"] = (($context["client_side_validation"] ?? null) && twig_in_filter($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "required", []), [0 => "on", 1 => "true", 2 => 1]));
            // line 41
            $context["autofocus"] = ((($context["inline_errors"] ?? null) == false) && twig_in_filter($this->getAttribute(($context["field"] ?? null), "autofocus", []), [0 => "on", 1 => "true", 2 => 1]));
            // line 43
            if ((($context["inline_errors"] ?? null) && ($context["errors"] ?? null))) {
                // line 44
                $context["autofocus"] = true;
            }
            // line 47
            ob_start();
            // line 48
            echo "  ";
            $this->displayBlock('outer_field_classes', $context, $blocks);
            $context["embed_outer_field_classes"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 52
            if (($context["errors"] ?? null)) {
                $context["form_field_outer_core"] = (($context["form_field_outer_core"] ?? null) . " has-errors");
            }
            // line 53
            if (($context["toggleable"] ?? null)) {
                $context["form_field_outer_core"] = (($context["form_field_outer_core"] ?? null) . " form-field-toggleable");
            }
            // line 55
            $context["layout_form_field_outer_classes"] = $this->getAttribute(($context["field"] ?? null), "outerclasses", []);
            // line 56
            $context["layout_form_field_outer_classes"] = ((twig_trim_filter(($context["layout_form_field_outer_classes"] ?? null)) . " ") . ($context["form_field_outer_classes"] ?? null));
            // line 57
            $context["layout_form_field_outer_classes"] = ((twig_trim_filter(($context["layout_form_field_outer_classes"] ?? null)) . " ") . ($context["embed_outer_field_classes"] ?? null));
            // line 60
            $context["show_label"] = ( !($this->getAttribute(($context["field"] ?? null), "label", []) === false) &&  !($this->getAttribute(($context["field"] ?? null), "display_label", []) === false));
            // line 63
            $context["layout_form_field_outer_label_classes"] = twig_trim_filter(((((($context["form_field_outer_label_classes"] ?? null)) ? (($context["form_field_outer_label_classes"] ?? null)) : ("form-label")) . " ") . $this->getAttribute(($context["field"] ?? null), "labelclasses", [])));
            // line 64
            $context["layout_form_field_label_classes"] = twig_trim_filter(((($context["form_field_label_classes"] ?? null)) ? (($context["form_field_label_classes"] ?? null)) : ("inline")));
            // line 65
            $context["form_field_label_trim"] = ((($context["toggleable"] ?? null)) ? ("toggleable") : (""));
            // line 68
            $context["layout_form_field_outer_data_classes"] = twig_trim_filter(((((($context["form_field_outer_data_classes"] ?? null)) ? (($context["form_field_outer_data_classes"] ?? null)) : (" form-data")) . " ") . $this->getAttribute(($context["field"] ?? null), "dataclasses", [])));
            // line 71
            $context["layout_form_field_wrapper_classes"] = twig_trim_filter(((((($context["form_field_wrapper_classes"] ?? null)) ? (($context["form_field_wrapper_classes"] ?? null)) : (" form-input-wrapper")) . " ") . $this->getAttribute(($context["field"] ?? null), "wrapper_classes", [])));
            // line 74
            if ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->ofTypeFunc(($context["field"] ?? null), "array")) {
                // line 75
                if ($this->getAttribute(($context["field"] ?? null), "classes", [])) {
                    // line 76
                    $context["field"] = twig_array_merge(($context["field"] ?? null), ["classes" => (($this->getAttribute(($context["field"] ?? null), "classes", []) . " ") . twig_trim_filter(                    $this->renderBlock("field_input_classes", $context, $blocks)))]);
                } else {
                    // line 78
                    $context["field"] = twig_array_merge(($context["field"] ?? null), ["classes" =>                     $this->renderBlock("field_input_classes", $context, $blocks)]);
                }
            }
            // line 81
            $context["layout_form_field_input_classes"] = twig_trim_filter(((($context["form_field_input_classes"] ?? null) . " ") . $this->getAttribute(($context["field"] ?? null), "classes", [])));
            // line 84
            $context["form_field_inline_error_classes"] = ((($context["form_field_inline_error_classes"] ?? null)) ? (($context["form_field_inline_error_classes"] ?? null)) : (" form-errors"));
            // line 87
            $context["form_field_extra_wrapper_classes"] = ("form-extra-wrapper " . $this->getAttribute(($context["field"] ?? null), "wrapper_classes", []));
            // line 90
            $context["form_field_for"] = ((($context["toggleable"] ?? null)) ? (("toggleable_" . $this->getAttribute(($context["field"] ?? null), "name", []))) : (twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "id", []))));
            // line 93
            $context["form_field_label"] = (($this->getAttribute(($context["field"] ?? null), "markdown", [])) ? ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->markdownFunction($context, $this->getAttribute(($context["field"] ?? null), "label", []), false)) : ($this->getAttribute(($context["field"] ?? null), "label", [])));
            // line 94
            $context["form_field_label"] = $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, (((isset($context["form_field_label"]) || array_key_exists("form_field_label", $context))) ? (_twig_default_filter(($context["form_field_label"] ?? null), twig_capitalize_string_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", [])))) : (twig_capitalize_string_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", [])))));
            // line 97
            if ($this->getAttribute(($context["field"] ?? null), "help", [])) {
                // line 98
                $context["form_field_help"] = (($this->getAttribute(($context["field"] ?? null), "markdown", [])) ? (twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->markdownFunction($context, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "help", [])), false))) : (twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "help", [])))));
            }
            // line 102
            $context["form_field_required"] = ((twig_in_filter($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "required", []), [0 => "on", 1 => "true", 2 => 1])) ? (true) : (false));
            // line 105
            $context["form_field_description"] = (($this->getAttribute(($context["field"] ?? null), "markdown", [])) ? ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->markdownFunction($context, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "description", [])), false)) : ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "description", []))));
        }
        // line 107
        $this->parent = $this->loadTemplate("forms/layouts/field.html.twig", "forms/default/field.html.twig", 107);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_field_override_variables_before($context, array $blocks = [])
    {
    }

    // line 48
    public function block_outer_field_classes($context, array $blocks = [])
    {
    }

    // line 109
    public function block_global_attributes($context, array $blocks = [])
    {
        // line 110
        echo "  data-grav-field=\"";
        echo $this->getAttribute(($context["field"] ?? null), "type", []);
        echo "\"
  data-grav-disabled=\"";
        // line 111
        echo (($context["toggleable"] ?? null) && ($context["toggleableChecked"] ?? null));
        echo "\"
  data-grav-default=\"";
        // line 112
        echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "default", [])), "html_attr");
        echo "\"
";
    }

    // line 115
    public function block_input_attributes($context, array $blocks = [])
    {
        // line 116
        echo "  class=\"";
        echo twig_trim_filter(($context["layout_form_field_input_classes"] ?? null));
        echo " ";
        echo $this->getAttribute(($context["field"] ?? null), "size", []);
        echo "\"
  ";
        // line 117
        if ($this->getAttribute(($context["field"] ?? null), "id", [], "any", true, true)) {
            echo "id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "id", []));
            echo "\" ";
        }
        // line 118
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "style", [], "any", true, true)) {
            echo "style=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "style", []));
            echo "\" ";
        }
        // line 119
        echo "  ";
        if (($this->getAttribute(($context["field"] ?? null), "disabled", []) || ($context["isDisabledToggleable"] ?? null))) {
            echo "disabled=\"disabled\"";
        }
        // line 120
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "placeholder", [])) {
            echo "placeholder=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "placeholder", [])), "html_attr");
            echo "\"";
        }
        // line 121
        echo "  ";
        if (($context["autofocus"] ?? null)) {
            echo "autofocus=\"autofocus\"";
        }
        // line 122
        echo "  ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "novalidate", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "novalidate=\"novalidate\"";
        }
        // line 123
        echo "  ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "readonly", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "readonly=\"readonly\"";
        }
        // line 124
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "autocomplete", [], "any", true, true)) {
            echo "autocomplete=\"";
            echo $this->getAttribute(($context["field"] ?? null), "autocomplete", []);
            echo "\"";
        }
        // line 125
        echo "  ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "autocapitalize", []), [0 => "off", 1 => "characters", 2 => "words", 3 => "sentences"])) {
            echo "autocapitalize=\"";
            echo $this->getAttribute(($context["field"] ?? null), "autocapitalize", []);
            echo "\"";
        }
        // line 126
        echo "  ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "inputmode", []), [0 => "none", 1 => "text", 2 => "decimal", 3 => "numeric", 4 => "tel", 5 => "search", 6 => "email", 7 => "url"])) {
            echo "inputmode=\"";
            echo $this->getAttribute(($context["field"] ?? null), "inputmode", []);
            echo "\"";
        }
        // line 127
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "tabindex", [])) {
            echo "tabindex=\"";
            echo $this->getAttribute(($context["field"] ?? null), "tabindex", []);
            echo "\"";
        }
        // line 128
        echo "  ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "spellcheck", []), [0 => "true", 1 => "false"])) {
            echo "spellcheck=\"";
            echo $this->getAttribute(($context["field"] ?? null), "spellcheck", []);
            echo "\"";
        }
        // line 129
        echo "  ";
        if (($context["required"] ?? null)) {
            echo "required=\"required\"";
        }
        // line 130
        echo "  ";
        if ($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "pattern", [])) {
            echo "pattern=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "pattern", []));
            echo "\"";
        }
        // line 131
        echo "  ";
        if ($this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "message", [])) {
            echo "title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute($this->getAttribute(($context["field"] ?? null), "validate", []), "message", [])));
            echo "\"
  ";
        } elseif ($this->getAttribute(        // line 132
($context["field"] ?? null), "title", [], "any", true, true)) {
            echo "title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate($this->env, $this->getAttribute(($context["field"] ?? null), "title", [])));
            echo "\" ";
        }
        // line 133
        echo "
  ";
        // line 135
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "attributes", [], "any", true, true)) {
            // line 136
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "attributes", []));
            foreach ($context['_seq'] as $context["key"] => $context["attribute"]) {
                // line 137
                echo "      ";
                if ($this->env->getExtension('Grav\Common\Twig\TwigExtension')->ofTypeFunc($context["attribute"], "array")) {
                    // line 138
                    echo "        ";
                    echo $this->getAttribute($context["attribute"], "name", []);
                    echo "=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["attribute"], "value", []), "html_attr");
                    echo "\"
      ";
                } else {
                    // line 140
                    echo "        ";
                    echo $context["key"];
                    echo "=\"";
                    echo twig_escape_filter($this->env, $context["attribute"], "html_attr");
                    echo "\"
      ";
                }
                // line 142
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['attribute'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 143
            echo "  ";
        }
        // line 144
        echo "
  ";
        // line 146
        echo "  ";
        if ($this->getAttribute(($context["field"] ?? null), "datasets", [])) {
            // line 147
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "datasets", []));
            foreach ($context['_seq'] as $context["key"] => $context["attribute"]) {
                // line 148
                echo "      data-";
                echo $context["key"];
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attribute"], "html_attr");
                echo "\"
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['attribute'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 150
            echo "  ";
        }
    }

    public function getTemplateName()
    {
        return "forms/default/field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  381 => 150,  370 => 148,  365 => 147,  362 => 146,  359 => 144,  356 => 143,  350 => 142,  342 => 140,  334 => 138,  331 => 137,  326 => 136,  323 => 135,  320 => 133,  314 => 132,  307 => 131,  300 => 130,  295 => 129,  288 => 128,  281 => 127,  274 => 126,  267 => 125,  260 => 124,  255 => 123,  250 => 122,  245 => 121,  238 => 120,  233 => 119,  226 => 118,  220 => 117,  213 => 116,  210 => 115,  204 => 112,  200 => 111,  195 => 110,  192 => 109,  187 => 48,  182 => 4,  177 => 107,  174 => 105,  172 => 102,  169 => 98,  167 => 97,  165 => 94,  163 => 93,  161 => 90,  159 => 87,  157 => 84,  155 => 81,  151 => 78,  148 => 76,  146 => 75,  144 => 74,  142 => 71,  140 => 68,  138 => 65,  136 => 64,  134 => 63,  132 => 60,  130 => 57,  128 => 56,  126 => 55,  122 => 53,  118 => 52,  114 => 48,  112 => 47,  109 => 44,  107 => 43,  105 => 41,  103 => 40,  101 => 39,  97 => 36,  94 => 35,  92 => 34,  90 => 33,  88 => 31,  85 => 27,  81 => 24,  79 => 23,  77 => 21,  75 => 20,  72 => 17,  70 => 16,  68 => 15,  66 => 14,  64 => 13,  62 => 12,  60 => 11,  58 => 10,  56 => 9,  54 => 7,  52 => 6,  50 => 1,  44 => 107,  23 => 3,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% if not field.validate.ignore  %}

{% use 'forms/layouts/field-variables.html.twig' %}
{% block field_override_variables_before %}{% endblock %}

{% set field_name = (scope ~ field.name)|fieldName %}
{% set vertical = field.style == 'vertical' %}

{% if not blueprints or (blueprints.schema.type(field.type)['input@'] ?? true) is same as(true) %}
    {% set toggleable = field.toggleable ?? false %}
    {% if toggleable %}
        {% set originalValue = originalValue is defined ? originalValue : value %}
        {% set toggleableChecked = originalValue is not null %}
    {% elseif field.overridable %}
        {% set toggleable = true %}
        {% set default = form.getDefaultValue(field.name) ?? field.default %}
        {% set toggleableChecked = value is not null and value != default %}
    {% endif %}

    {% set cookie_name = 'forms-' ~ form.name ~ '-' ~ field.name %}
    {% set value = value ?? (get_cookie(cookie_name) is not null ? get_cookie(cookie_name) : field.default) %}

    {% if (field.yaml or field.validate.type == 'yaml') and value is iterable %}
        {% set value = value|toYaml %}
    {% endif %}
{% else %}
    {% set toggleable = false %}
{% endif %}

{# DEPRECATED: Needed by old form fields; remove when backwards compatibility breaks are allowed #}
{% set isDisabledToggleable = toggleable and not toggleableChecked %}

{% if toggleable %}
  {% set form_field_toggleable %}
    {% include 'forms/default/toggleable.html.twig' with {checked: toggleableChecked} %}
  {% endset %}
{% endif %}

{% set errors = attribute(form.messages, field.name) %}
{% set required = client_side_validation and field.validate.required in ['on', 'true', 1] %}
{% set autofocus = (inline_errors == false) and field.autofocus in ['on', 'true', 1] %}

{% if inline_errors and errors %}
    {% set autofocus = true %}
{% endif %}

{% set embed_outer_field_classes %}
  {% block outer_field_classes %}{% endblock %}
{% endset %}

{# Field Classes #}
{%- if errors %}{% set form_field_outer_core = form_field_outer_core ~ ' has-errors'  %}{% endif -%}
{%- if toggleable %}{% set form_field_outer_core = form_field_outer_core ~ ' form-field-toggleable' %}{% endif -%}

{% set layout_form_field_outer_classes = field.outerclasses %}
{% set layout_form_field_outer_classes = layout_form_field_outer_classes|trim ~ ' ' ~ form_field_outer_classes %}
{% set layout_form_field_outer_classes = layout_form_field_outer_classes|trim ~ ' ' ~ embed_outer_field_classes %}

{# Show Label logic #}
{% set show_label = field.label is not same as(false) and field.display_label is not same as(false )%}

{# Label Classes #}
{% set layout_form_field_outer_label_classes = ((form_field_outer_label_classes ?: 'form-label') ~ ' ' ~ field.labelclasses)|trim %}
{% set layout_form_field_label_classes = (form_field_label_classes ?: 'inline')|trim %}
{% set form_field_label_trim = toggleable ? 'toggleable' %}

{# Field Outer Data classes #}
{% set layout_form_field_outer_data_classes = ((form_field_outer_data_classes ?: ' form-data') ~ ' ' ~ field.dataclasses)|trim  %}

{# Field Wrapper classes #}
{% set layout_form_field_wrapper_classes = ((form_field_wrapper_classes ?: ' form-input-wrapper') ~ ' ' ~ field.wrapper_classes)|trim %}

{# Field input classes #}
{% if field|of_type('array') %}
  {% if field.classes %}
    {% set field = field|merge({'classes': field.classes ~ ' ' ~ block('field_input_classes')|trim }) %}
  {% else %}
    {% set field = field|merge({'classes': block('field_input_classes') }) %}
  {% endif %}
{% endif %}
{% set layout_form_field_input_classes = (form_field_input_classes ~ ' ' ~ field.classes)|trim %}

{# Inline error classes #}
{% set form_field_inline_error_classes = form_field_inline_error_classes ?: ' form-errors' %}

{# Field extra classes #}
{% set form_field_extra_wrapper_classes = 'form-extra-wrapper ' ~ field.wrapper_classes %}

{# Field For #}
{% set form_field_for = toggleable ? 'toggleable_' ~ field.name : field.id|e %}

{# Field Label #}
{% set form_field_label = field.markdown ? field.label|markdown(false) : field.label %}
{% set form_field_label = form_field_label|default(field.name|capitalize)|t %}

{# Field Help #}
{% if field.help %}
    {% set form_field_help = field.markdown ? field.help|t|markdown(false)|e : field.help|t|e %}
{% endif %}

{# Field Requied #}
{% set form_field_required = field.validate.required in ['on', 'true', 1] ? true : false %}

{# Field Description #}
{% set form_field_description = field.markdown ? field.description|t|markdown(false)|raw : field.description|t|raw %}

{% extends 'forms/layouts/field.html.twig' %}

{% block global_attributes %}
  data-grav-field=\"{{ field.type }}\"
  data-grav-disabled=\"{{ toggleable and toggleableChecked }}\"
  data-grav-default=\"{{ field.default|json_encode()|e('html_attr') }}\"
{% endblock %}

{% block input_attributes %}
  class=\"{{ layout_form_field_input_classes|trim }} {{ field.size }}\"
  {% if field.id is defined %}id=\"{{ field.id|e }}\" {% endif %}
  {% if field.style is defined %}style=\"{{ field.style|e }}\" {% endif %}
  {% if field.disabled or isDisabledToggleable %}disabled=\"disabled\"{% endif %}
  {% if field.placeholder %}placeholder=\"{{ field.placeholder|t|e('html_attr') }}\"{% endif %}
  {% if autofocus %}autofocus=\"autofocus\"{% endif %}
  {% if field.novalidate in ['on', 'true', 1] %}novalidate=\"novalidate\"{% endif %}
  {% if field.readonly in ['on', 'true', 1] %}readonly=\"readonly\"{% endif %}
  {% if field.autocomplete is defined %}autocomplete=\"{{ field.autocomplete }}\"{% endif %}
  {% if field.autocapitalize in ['off', 'characters', 'words', 'sentences'] %}autocapitalize=\"{{ field.autocapitalize }}\"{% endif %}
  {% if field.inputmode in ['none', 'text', 'decimal', 'numeric', 'tel', 'search', 'email', 'url'] %}inputmode=\"{{ field.inputmode }}\"{% endif %}
  {% if field.tabindex %}tabindex=\"{{ field.tabindex }}\"{% endif %}
  {% if field.spellcheck in ['true', 'false'] %}spellcheck=\"{{ field.spellcheck }}\"{% endif %}
  {% if required %}required=\"required\"{% endif %}
  {% if field.validate.pattern %}pattern=\"{{ field.validate.pattern|e }}\"{% endif %}
  {% if field.validate.message %}title=\"{{ field.validate.message|t|e }}\"
  {% elseif field.title is defined %}title=\"{{ field.title|t|e }}\" {% endif %}

  {# Support key/value and .name/.value styles #}
  {% if field.attributes is defined %}
    {% for key,attribute in field.attributes %}
      {% if attribute|of_type('array') %}
        {{ attribute.name }}=\"{{ attribute.value|e('html_attr') }}\"
      {% else %}
        {{ key }}=\"{{ attribute|e('html_attr') }}\"
      {% endif %}
    {% endfor %}
  {% endif %}

  {# Support for Custom data attributes#}
  {% if field.datasets %}
    {% for key, attribute in field.datasets %}
      data-{{ key }}=\"{{ attribute|e('html_attr') }}\"
    {% endfor %}
  {% endif %}
{% endblock %}



{% endif %}
", "forms/default/field.html.twig", "/var/www/html/user/plugins/form/templates/forms/default/field.html.twig");
    }
}
