<?php

/* MediaMediaBundle:Pages:downloads.html.twig */
class __TwigTemplate_a140a137573416298e5002a3d3f14e6f extends Twig_Template
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
        echo "<a href=\"#\">Downloads</a>
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<div class=\"row-fluid sortable ui-sortable\">
    <div class=\"box span4\">
\t<div class=\"box-header\"><h2><i class=\"icon-th\"></i> Change Speed</h2></div>
            <div class=\"box-content\"><div class=\"well\" style=\"width: 400px\">
            <center>
            <a href=\"/actions/sab.php?action=setspeed&speed=1024\" class=\"btn btn-info\">1 MB/s</a>
            <a href=\"/actions/sab.php?action=setspeed&speed=2048\" class=\"btn btn-info\">2 MB/s</a>
            <a href=\"/actions/sab.php?action=setspeed&speed=3072\" class=\"btn btn-info\">3 MB/s</a>
            <a href=\"/actions/sab.php?action=setspeed&speed=0\" class=\"btn btn-info\">Max</a>
            <a href=\"/actions/sab.php?action=pauseall\" class=\"btn btn-info\"><i class=\"icon-white icon-pause\"></i></a>
            <br /><br />

            <form name=\"customspeed\" class=\"customspeed\" method=\"POST\" action=\"/actions/sab.php?action=setspeed\">
                <div class=\"input-prepend input-append\">
                <span class=\"add-on\">Custom</span>
                <input type=\"text\" name=\"speed\" class=\"sabspeed\" placeholder=\"Numbers only!\" id=\"appendedButtonprependedInput\" onFocus=\"\$(this).val('')\" />
                <button type=\"submit\" name=\"submit\" class=\"btn btn-success\">Set</button>
                </div>
            </form>
             </center>
</div></div> <!-- End content -->
    </div><!--/span-->

    <div class=\"box span5\">
\t<div class=\"box-header\"><h2><i class=\"icon-th\"></i> Quick Info</h2></div>
            <div class=\"box-content\" style=\"text-align: center\"><div class=\"well\" id=\"sabquickinfo\">[[Sab::info()]]</div></div> <!-- End content -->
    </div><!--/span-->

    <div class=\"box span3\">
\t<div class=\"box-header\"><h2><i class=\"icon-th\"></i> Quick Config</h2></div>
            <div class=\"box-content\" style=\"text-align: center\"><div class=\"well\">Some Quick Config Options</div></div> <!-- End content -->
    </div><!--/span-->
</div><!--/row -->




<div class=\"row-fluid sortable ui-sortable\">
\t\t\t\t<div class=\"box span12\">
\t\t\t\t\t<div class=\"box-header\">
\t\t\t\t\t\t<h2><i class=\"icon-th\"></i> Download Queue</h2>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"box-content\">\t\t\t\t
  <div class='tab-pane active' id='downloads'><div id=\"sabdownloads\">[[include 'pages/tables/tablehead.downloads.tpl']] [[Sab::format_queue()]] [[include 'pages/tables/tablefoot.tpl']]</div></div>
</div>
\t\t\t\t</div><!--/span-->
\t\t\t
\t\t\t</div>

<div class=\"row-fluid sortable ui-sortable\">
\t\t\t\t<div class=\"box span12\">
\t\t\t\t\t<div class=\"box-header\">
\t\t\t\t\t\t<h2><i class=\"icon-th\"></i> Download History</h2>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"box-content\">
  <div class='tab-pane' id='history'><div id=\"sabhistory\">[[include 'pages/tables/tablehead.history.tpl']] [[Sab::format_history()]] [[include 'pages/tables/tablefoot.tpl']]</div></div>

</div>
\t\t\t\t</div><!--/span-->
\t\t\t
\t\t\t</div>
";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:downloads.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 9,  37 => 8,  32 => 5,  29 => 4,);
    }
}
