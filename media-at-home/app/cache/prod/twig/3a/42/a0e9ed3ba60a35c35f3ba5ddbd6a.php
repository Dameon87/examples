<?php

/* MediaMediaBundle:Pages:tv-schedule.html.twig */
class __TwigTemplate_3a42a0e9ed3ba60a35c35f3ba5ddbd6a extends Twig_Template
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
        echo "TV Schedule
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<div class=\"row-fluid\">

                <div class=\"box span12\">
                    <div class=\"box-header\">
                        <h2><i class=\"icon-th\"></i> Upcoming Episode Schedule</h2>
                    </div>
                    <div class=\"box-content\">
\t\t\t\t\t\t[[TV::get_shows_schedule()]]
\t\t\t\t\t</div>
                </div><!--/span-->

            </div>
";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:tv-schedule.html.twig";
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
