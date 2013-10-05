<?php

/* MediaMediaBundle:Pages:tv-shows.html.twig */
class __TwigTemplate_ae5642fd1893878b69511c13204af021 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MediaMediaBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "TV Shows
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<!-- Add a show modal/button. Can be put anywhere. -->
[[include 'pages/add_a_show.tpl']]
<!-- End add a show modal/button. -->

<div class=\"row-fluid\">
\t\t\t\t
\t\t\t\t<div class=\"box span12\">
\t\t\t\t\t<div class=\"box-header\">
\t\t\t\t\t\t<h2><i class=\"icon-th\"></i> Shows</h2>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"box-content\">
\t\t\t\t\t\t<ul class=\"nav tab-menu nav-tabs\" id=\"myTab\">
                                                        <li class=\"active\"><a href=\"#shows\">All Shows</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t 
\t\t\t\t\t\t<div class='tab-content'>
  \t\t\t\t\t\t\t<div class='tab-pane active' id='shows'>

\t\t\t\t\t\t\t<table class=\"table table-striped table-bordered bootstrap-datatable datatable\">
\t\t\t\t\t\t\t\t<thead>
    \t\t\t\t\t\t\t\t<tr>
    \t\t\t\t\t\t\t\t\t<th style=\"width: 200px;\">Next Episode</th>
    \t\t\t\t\t\t\t\t\t<th>Title</th>
    \t\t\t\t\t\t\t\t\t<th>Network</th>
    \t\t\t\t\t\t\t\t\t<th>Quality</th>
    \t\t\t\t\t\t\t\t\t<th>Episodes</th>
    \t\t\t\t\t\t\t\t\t<th>Active</th>
    \t\t\t\t\t\t\t\t</tr>
    \t\t\t\t\t\t\t</thead>
\t\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t";
        // line 39
        echo (isset($context["shows"]) ? $context["shows"] : $this->getContext($context, "shows"));
        echo "
\t\t\t\t\t\t\t\t</tbody>
           \t \t\t\t\t</table>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t</div><!--/span-->
\t\t\t
\t\t\t</div>

";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:tv-shows.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 39,  40 => 9,  37 => 8,  32 => 5,  29 => 4,);
    }
}
