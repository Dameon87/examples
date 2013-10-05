<?php

/* MediaMediaBundle:Pages:search.html.twig */
class __TwigTemplate_8004de36ad0d87563d72205e627f5151 extends Twig_Template
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
        echo "<div class=\"row-fluid sortable ui-sortable\">
    <div class=\"box span12\">
\t<div class=\"box-header\"><h2><i class=\"icon-th\"></i> NZB Search</h2></div>
\t<div class=\"box-content\">
        <div class=\"well\">
\t<form class='search' action='/actions/search.php' method='POST' onsubmit=\"return false\">
<input name='searchfor' type=\"text\" placeholder=\"Search for...\" />
<span class=\"input-prepend\">
<span class=\"add-on\">Type</span>
<select name='type' id='type prependedInput'>
  <option value='Movies'>Movies</option>
  <option value='TV'>TV Shows</option>
  <option value='games-pc'>PC Games</option>
  <option value='games-mac'>MAC Games</option>
  <option value='games-linux'>Linux Games</option>
  <option value='apps-windows'>Windows Applications</option>
  <option value='apps-mac'>MAC Applications</option>
  <option value='apps-linux'>Linux Applications</option>
</select>
</span>
&nbsp;
<span class=\"input-prepend\">
<span class=\"add-on\">Quality</span>
<select name='quality' id='quality prependedInput'>
  <option value='1080P'>1080p</option>
  <option value='720P'>720p</option>
  <option value='BRRip'>Blue Ray Rip</option>
  <option value='DVDR'>DVD Rip</option>
  <option value='HD'>HD</option>
  <option value='SD'>SD</option>
  <option value='3D'>3D</option>
  <option value='HDTV' id='tv-only'>HDTV</option>
  <option value='SDTV' id='tv-only'>SDTV</option>
  <option value='any'>All</option>
</select>
</span>
&nbsp;

<input name='season' class=\"span1\" type=\"text\" placeholder=\"Season\">
<input name='episode' class=\"span1\" type=\"text\" placeholder=\"Episode\">

<span class=\"input-prepend\">
<span class=\"add-on\">Provider</span>
<select name='provider' id='quality prependedInput'>
  <option value='newznab'>Newznab</option>
  <option value='nzbmatrix'>NZBMatrix</option>
</select>
</span>
&nbsp;
<button type='submit' class='btn btn-success' style='position: relative; top: -5px;'>Search</button>

</form>
</div> <!-- End well -->
        </div>
    </div><!--/span-->
</div>

<div class=\"well\" id=\"searchresults\" style='display: none;'> </div>

";
    }

    public function getTemplateName()
    {
        return "MediaMediaBundle:Pages:search.html.twig";
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
