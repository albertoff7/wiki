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

/* shortcodes/prism-highlight.html.twig */
class __TwigTemplate_55d6fd7e052d89033cbd6606bcb1674861c2a41acf28cd3704d084e88f270bee extends \Twig\Template
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
        echo "<div class=\"prism-wrapper\">
<pre class=\"";
        // line 2
        echo ($context["classes"] ?? null);
        echo "\"
    ";
        // line 3
        if (($context["cl_output"] ?? null)) {
            echo "data-output=\"";
            echo ($context["cl_output"] ?? null);
            echo "\"";
        }
        // line 4
        echo "    ";
        if (($context["cl_prompt"] ?? null)) {
            echo "data-prompt=\"";
            echo ($context["cl_prompt"] ?? null);
            echo "\"";
        }
        // line 5
        echo "    ";
        if (($context["ln_start"] ?? null)) {
            echo "data-start=\"";
            echo ($context["ln_start"] ?? null);
            echo "\"";
        }
        // line 6
        echo "    ";
        if (($context["highlight_lines"] ?? null)) {
            echo "data-line=\" ";
            echo ($context["highlight_lines"] ?? null);
            echo "\"";
        }
        // line 7
        echo "><code>";
        echo twig_escape_filter($this->env, ($context["content"] ?? null), "html");
        echo "</code></pre>
</div>
";
    }

    public function getTemplateName()
    {
        return "shortcodes/prism-highlight.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 7,  57 => 6,  50 => 5,  43 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"prism-wrapper\">
<pre class=\"{{ classes }}\"
    {% if cl_output %}data-output=\"{{ cl_output }}\"{% endif %}
    {% if cl_prompt %}data-prompt=\"{{ cl_prompt }}\"{% endif %}
    {% if ln_start %}data-start=\"{{ ln_start }}\"{% endif %}
    {% if highlight_lines %}data-line=\" {{ highlight_lines }}\"{% endif %}
><code>{{- content|e('html') -}}</code></pre>
</div>
", "shortcodes/prism-highlight.html.twig", "/var/www/html/user/plugins/prism-highlight/templates/shortcodes/prism-highlight.html.twig");
    }
}
