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

/* partials/base.html.twig */
class __TwigTemplate_b7f69db6ffaa57f54b4b800ddfb98e521a6d76cd35a63bc33370b735a01dcc0d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'assets' => [$this, 'block_assets'],
            'body_classes' => [$this, 'block_body_classes'],
            'topbar' => [$this, 'block_topbar'],
            'body' => [$this, 'block_body'],
            'messages' => [$this, 'block_messages'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
            'bottom' => [$this, 'block_bottom'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["github_config"] = $this->env->getExtension('Grav\Common\Twig\TwigExtension')->themeVarFunc("github");
        // line 2
        $context["grid_size"] = $this->env->getExtension('Grav\Common\Twig\TwigExtension')->themeVarFunc("grid-size");
        // line 3
        $context["compress"] = (($this->env->getExtension('Grav\Common\Twig\TwigExtension')->themeVarFunc("production-mode")) ? (".min.css") : (".css"));
        // line 4
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 5
        echo (($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) ? ($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) : ($this->getAttribute($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "config", []), "site", []), "default_lang", [])));
        echo "\">
<head>
";
        // line 7
        $this->displayBlock('head', $context, $blocks);
        // line 18
        echo "
";
        // line 19
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 24
        echo "
";
        // line 25
        $this->displayBlock('javascripts', $context, $blocks);
        // line 29
        echo "
";
        // line 30
        $this->displayBlock('assets', $context, $blocks);
        // line 34
        echo "</head>
<body id=\"top\" class=\"";
        // line 35
        echo ($context["sidebar_color"] ?? null);
        echo " ";
        $this->displayBlock('body_classes', $context, $blocks);
        echo "\" data-url=\"";
        echo $this->getAttribute(($context["page"] ?? null), "route", []);
        echo "\">
    <div id=\"page-wrapper\" class=\"off-canvas off-canvas-sidebar-show\">
        <!-- off-screen toggle button -->
        <a class=\"off-canvas-toggle btn btn-primary btn-action\" href=\"#sidebar-id\">
            <i class=\"fa fa-bars\"></i>
        </a>

        <div id=\"sidebar-id\" class=\"learn-sidebar off-canvas-sidebar\">
            <!-- off-screen sidebar -->
            ";
        // line 44
        $this->loadTemplate("partials/sidebar.html.twig", "partials/base.html.twig", 44)->display($context);
        // line 45
        echo "        </div>

        <a class=\"off-canvas-overlay\" href=\"#close\"></a>

        <div class=\"learn-content off-canvas-content\">
            ";
        // line 50
        $this->displayBlock('topbar', $context, $blocks);
        // line 53
        echo "
            <section id=\"start\">
                ";
        // line 55
        $this->displayBlock('body', $context, $blocks);
        // line 65
        echo "            </section>

            ";
        // line 67
        $this->displayBlock('footer', $context, $blocks);
        // line 70
        echo "        </div>
    </div>

    ";
        // line 73
        $this->displayBlock('bottom', $context, $blocks);
        // line 77
        echo "</body>
</html>
";
        $this->env->getExtension('Phive\Twig\Extensions\Deferred\DeferredExtension')->resolve($this, $context, $blocks);
    }

    public function block_head($context, array $blocks = array())
    {
        $this->env->getExtension('Phive\Twig\Extensions\Deferred\DeferredExtension')->defer($this, 'head');
    }

    // line 7
    public function block_head_deferred($context, array $blocks = array())
    {
        // line 8
        echo "    <meta charset=\"utf-8\" />
    <title>";
        // line 9
        if ($this->getAttribute(($context["page"] ?? null), "title", [])) {
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "title", []), "html");
            echo " | ";
        }
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site"] ?? null), "title", []), "html");
        echo "</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    ";
        // line 13
        $this->loadTemplate("partials/metadata.html.twig", "partials/base.html.twig", 13)->display($context);
        // line 14
        echo "
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 15
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->urlFunc("theme://images/favicon.png");
        echo "\" />
    <link rel=\"canonical\" href=\"";
        // line 16
        echo $this->getAttribute(($context["page"] ?? null), "url", [0 => true, 1 => true], "method");
        echo "\" />
";
        $this->env->getExtension('Phive\Twig\Extensions\Deferred\DeferredExtension')->resolve($this, $context, $blocks);
    }

    // line 19
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 20
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => "theme://css/fork-awesome.min.css"], "method");
        // line 21
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre" . ($context["compress"] ?? null))], "method");
        // line 22
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/theme" . ($context["compress"] ?? null))], "method");
    }

    // line 25
    public function block_javascripts($context, array $blocks = [])
    {
        // line 26
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "jquery", 1 => 101], "method");
        // line 27
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "theme://js/learn4.js", 1 => ["group" => "bottom"]], "method");
    }

    public function block_assets($context, array $blocks = array())
    {
        $this->env->getExtension('Phive\Twig\Extensions\Deferred\DeferredExtension')->defer($this, 'assets');
    }

    // line 30
    public function block_assets_deferred($context, array $blocks = array())
    {
        // line 31
        echo "    ";
        echo $this->getAttribute(($context["assets"] ?? null), "css", [], "method");
        echo "
    ";
        // line 32
        echo $this->getAttribute(($context["assets"] ?? null), "js", [], "method");
        echo "
";
        $this->env->getExtension('Phive\Twig\Extensions\Deferred\DeferredExtension')->resolve($this, $context, $blocks);
    }

    // line 35
    public function block_body_classes($context, array $blocks = [])
    {
        echo twig_trim_filter(($context["body_classes"] ?? null));
    }

    // line 50
    public function block_topbar($context, array $blocks = [])
    {
        // line 51
        echo "                ";
        $this->loadTemplate("partials/topbar.html.twig", "partials/base.html.twig", 51)->display($context);
        // line 52
        echo "            ";
    }

    // line 55
    public function block_body($context, array $blocks = [])
    {
        // line 56
        echo "                    <section id=\"body-wrapper\" class=\"section\">
                        <section class=\"container ";
        // line 57
        echo ($context["grid_size"] ?? null);
        echo "\">
                            ";
        // line 58
        $this->displayBlock('messages', $context, $blocks);
        // line 61
        echo "                            ";
        $this->displayBlock('content', $context, $blocks);
        // line 62
        echo "                        </section>
                    </section>
                ";
    }

    // line 58
    public function block_messages($context, array $blocks = [])
    {
        // line 59
        echo "                                ";
        $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
        try {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =             $this->loadTemplate("partials/messages.html.twig", "partials/base.html.twig", 59);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
        }
        // line 60
        echo "                            ";
    }

    // line 61
    public function block_content($context, array $blocks = [])
    {
    }

    // line 67
    public function block_footer($context, array $blocks = [])
    {
        // line 68
        echo "                ";
        $this->loadTemplate("partials/footer.html.twig", "partials/base.html.twig", 68)->display($context);
        // line 69
        echo "            ";
    }

    // line 73
    public function block_bottom($context, array $blocks = [])
    {
        // line 74
        echo "        <script src=\"https://unpkg.com/simplebar@4.0.0-alpha.4/dist/simplebar.min.js\"></script>
        ";
        // line 75
        echo $this->getAttribute(($context["assets"] ?? null), "js", [0 => "bottom"], "method");
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 75,  284 => 74,  281 => 73,  277 => 69,  274 => 68,  271 => 67,  266 => 61,  262 => 60,  251 => 59,  248 => 58,  242 => 62,  239 => 61,  237 => 58,  233 => 57,  230 => 56,  227 => 55,  223 => 52,  220 => 51,  217 => 50,  211 => 35,  204 => 32,  199 => 31,  196 => 30,  186 => 27,  183 => 26,  180 => 25,  175 => 22,  172 => 21,  169 => 20,  166 => 19,  159 => 16,  155 => 15,  152 => 14,  150 => 13,  139 => 9,  136 => 8,  133 => 7,  121 => 77,  119 => 73,  114 => 70,  112 => 67,  108 => 65,  106 => 55,  102 => 53,  100 => 50,  93 => 45,  91 => 44,  75 => 35,  72 => 34,  70 => 30,  67 => 29,  65 => 25,  62 => 24,  60 => 19,  57 => 18,  55 => 7,  50 => 5,  47 => 4,  45 => 3,  43 => 2,  41 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set github_config = theme_var('github') %}
{% set grid_size = theme_var('grid-size') %}
{% set compress = theme_var('production-mode') ? '.min.css' : '.css' %}
<!DOCTYPE html>
<html lang=\"{{ grav.language.getActive ?: grav.config.site.default_lang }}\">
<head>
{% block head deferred %}
    <meta charset=\"utf-8\" />
    <title>{% if page.title %}{{ page.title|e('html') }} | {% endif %}{{ site.title|e('html') }}</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    {% include 'partials/metadata.html.twig' %}

    <link rel=\"icon\" type=\"image/png\" href=\"{{ url('theme://images/favicon.png') }}\" />
    <link rel=\"canonical\" href=\"{{ page.url(true, true) }}\" />
{% endblock head %}

{% block stylesheets %}
    {% do assets.addCss('theme://css/fork-awesome.min.css') %}
    {% do assets.addCss('theme://css-compiled/spectre'~compress) %}
    {% do assets.addCss('theme://css-compiled/theme'~compress) %}
{% endblock %}

{% block javascripts %}
    {% do assets.addJs('jquery', 101) %}
    {% do assets.addJs('theme://js/learn4.js', { group:'bottom' }) %}
{% endblock %}

{% block assets deferred %}
    {{ assets.css()|raw }}
    {{ assets.js()|raw }}
{% endblock %}
</head>
<body id=\"top\" class=\"{{ sidebar_color }} {% block body_classes %}{{ body_classes|trim }}{% endblock %}\" data-url=\"{{ page.route }}\">
    <div id=\"page-wrapper\" class=\"off-canvas off-canvas-sidebar-show\">
        <!-- off-screen toggle button -->
        <a class=\"off-canvas-toggle btn btn-primary btn-action\" href=\"#sidebar-id\">
            <i class=\"fa fa-bars\"></i>
        </a>

        <div id=\"sidebar-id\" class=\"learn-sidebar off-canvas-sidebar\">
            <!-- off-screen sidebar -->
            {% include 'partials/sidebar.html.twig' %}
        </div>

        <a class=\"off-canvas-overlay\" href=\"#close\"></a>

        <div class=\"learn-content off-canvas-content\">
            {% block topbar %}
                {% include 'partials/topbar.html.twig' %}
            {% endblock %}

            <section id=\"start\">
                {% block body %}
                    <section id=\"body-wrapper\" class=\"section\">
                        <section class=\"container {{ grid_size }}\">
                            {% block messages %}
                                {% include 'partials/messages.html.twig' ignore missing %}
                            {% endblock %}
                            {% block content %}{% endblock %}
                        </section>
                    </section>
                {% endblock %}
            </section>

            {% block footer %}
                {% include 'partials/footer.html.twig' %}
            {% endblock %}
        </div>
    </div>

    {% block bottom %}
        <script src=\"https://unpkg.com/simplebar@4.0.0-alpha.4/dist/simplebar.min.js\"></script>
        {{ assets.js('bottom')|raw }}
    {% endblock %}
</body>
</html>
", "partials/base.html.twig", "/var/www/html/user/themes/learn4/templates/partials/base.html.twig");
    }
}
