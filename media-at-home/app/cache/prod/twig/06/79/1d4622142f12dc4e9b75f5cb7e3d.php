<?php

/* MediaMediaBundle:Pages:movies.html.twig */
class __TwigTemplate_06791d4622142f12dc4e9b75f5cb7e3d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MediaMediaBundle::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MediaMediaBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "[[include 'pages/add_a_movie.tpl']]

<div class=\"row-fluid sortable\">\t\t
    <div class=\"box span12\">
\t<div class=\"box-header\" data-original-title>
\t    <h2><i class=\"icon-user\"></i><span class=\"break\"></span>Limit Results by First Letter/Number</h2>
\t    <div class=\"box-icon\"><a href=\"#\" class=\"btn-setting\"><i class=\"icon-wrench\"></i></a><a href=\"#\" class=\"btn-minimize\"><i class=\"icon-chevron-up\"></i></a></div>
\t</div>
\t<div class=\"box-content\" style=\"overflow: auto;\">[[Movies::create_jump_list()]]</div>
    </div> <!-- /span -->
</div>
<div class=\"row-fluid sortable\">\t\t
    <div class=\"box span12\">
\t<div class=\"box-header\" data-original-title>
\t    <h2><i class=\"icon-user\"></i><span class=\"break\"></span>All Movies</h2>
\t    <div class=\"box-icon\"><a href=\"#\" class=\"btn-setting\"><i class=\"icon-wrench\"></i></a><a href=\"#\" class=\"btn-minimize\"><i class=\"icon-chevron-up\"></i></a></div>
\t</div>
\t<div class=\"box-content\" style=\"overflow: auto;\">[[include \"pages/tables/tablehead.\$page.tpl\"]] [[Movies::list_movies('none')]] [[include 'pages/tables/tablefoot.tpl']]</div>
    </div> <!-- /span -->
</div>
";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:movies.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 5,  28 => 4,);
    }
}
