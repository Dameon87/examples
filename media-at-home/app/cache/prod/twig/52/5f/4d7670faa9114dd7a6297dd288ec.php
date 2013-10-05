<?php

/* MediaMediaBundle:Pages:movie-schedule.html.twig */
class __TwigTemplate_525f4d7670faa9114dd7a6297dd288ec extends Twig_Template
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

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"row-fluid\">

                <div class=\"box span12\">
                    <div class=\"box-header\">
                        <h2><i class=\"icon-th\"></i> Upcoming Episode Schedule</h2>
                    </div>
                    <div class=\"box-content\">
\t\t\t\t\t\tList shall reside here.
\t\t\t\t\t</div>
                </div><!--/span-->

            </div>
";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:movie-schedule.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
