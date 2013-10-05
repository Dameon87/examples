<?php

/* ::base.html.twig */
class __TwigTemplate_df590ba04fadd18f2351f231d1ba4beb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- app/Resources/views/base.html.twig -->
<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"utf-8\">
\t<title>[[\$ptitle]]</title>
\t
\t<!-- start: Mobile Specific -->
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<!-- end: Mobile Specific -->

\t<!-- start: CSS -->
\t";
        // line 13
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 20
        echo "\t<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
\t<!--[if lt IE 9]>
\t  <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
\t<![endif]-->
\t<!-- start: Favicon -->
\t<link rel=\"shortcut icon\" href=\"img/favicon.ico\">
\t<!-- end: Favicon -->\t
</head>

<body>
\t\t<!-- start: Header -->
\t<div class=\"navbar\">
\t\t<div class=\"navbar-inner\">
\t\t\t<div class=\"container-fluid\">
\t\t\t\t<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".top-nav.nav-collapse,.sidebar-nav.nav-collapse\">
\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t</a>
\t\t\t\t<a class=\"brand\" href=\"/\"> <span>";
        // line 39
        echo twig_escape_filter($this->env, (isset($context["sitename"]) ? $context["sitename"] : $this->getContext($context, "sitename")), "html", null, true);
        echo "</span></a>
\t\t\t\t<!-- start: Header Menu -->
\t\t\t\t<div class=\"btn-group pull-right\" >
\t\t\t\t\t<a class=\"btn\" href=\"#\">
\t\t\t\t\t\t<i class=\"icon-warning-sign\"></i><span class=\"hidden-phone hidden-tablet\"> notifications</span> <span class=\"label label-important hidden-phone\">2</span> <span class=\"label label-success hidden-phone\">11</span>
\t\t\t\t\t</a>
\t\t\t\t\t<a class=\"btn\" href=\"#\">
\t\t\t\t\t\t<i class=\"icon-tasks\"></i><span class=\"hidden-phone hidden-tablet\"> tasks</span> <span class=\"label label-warning hidden-phone\">17</span>
\t\t\t\t\t</a>
\t\t\t\t\t<a class=\"btn\" href=\"#\">
\t\t\t\t\t\t<i class=\"icon-envelope\"></i><span class=\"hidden-phone hidden-tablet\"> messages</span> <span class=\"label label-success hidden-phone\">9</span>
\t\t\t\t\t</a>
\t\t\t\t\t<a class=\"btn\" href=\"/settings.html\">
\t\t\t\t\t\t<i class=\"icon-wrench\"></i><span class=\"hidden-phone hidden-tablet\"> settings</span>
\t\t\t\t\t</a>
\t\t\t\t\t<!-- start: User Dropdown -->
\t\t\t\t\t<a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
\t\t\t\t\t\t<i class=\"icon-user\"></i><span class=\"hidden-phone hidden-tablet\"> Guest</span>
\t\t\t\t\t\t<span class=\"caret\"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t<li><a href=\"login.html\">Login</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t<!-- end: User Dropdown -->
\t\t\t\t</div>
\t\t\t\t<!-- end: Header Menu -->
\t\t\t\t
\t\t\t</div>
\t\t</div>
\t</div>
\t<div id=\"under-header\"></div>
\t<!-- start: Header -->
\t
\t\t<div class=\"container-fluid\">
\t\t<div class=\"row-fluid\">
\t\t\t\t
\t\t\t<!-- start: Main Menu -->
\t\t\t<div class=\"span2 main-menu-span\">
\t\t\t\t<div class=\"nav-collapse sidebar-nav\">
\t\t\t\t\t<ul class=\"nav nav-tabs nav-stacked main-menu\">
\t\t\t\t\t\t<li class=\"nav-header hidden-tablet\">Navigation</li>
\t\t\t\t\t\t<li><a href=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_homepage"), "html", null, true);
        echo "\"><i class=\"icon-home\"></i><span class=\"hidden-tablet\"> Dashboard</span></a></li>
\t\t\t\t\t\t<li><a href=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_downloads"), "html", null, true);
        echo "\"><i class=\"icon-eye-open\"></i><span class=\"hidden-tablet\"> Downloads</span></a></li>
\t\t\t\t\t\t<li><a href=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_tvshows"), "html", null, true);
        echo "\"><i class=\"icon-edit\"></i><span class=\"hidden-tablet\"> TV Shows</span></a></li>
\t\t\t\t\t\t<li><a href=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_tvschedule"), "html", null, true);
        echo "\"><i class=\"icon-edit\"></i><span class=\"hidden-tablet\"> TV Schedule</span></a></li>
\t\t\t\t\t\t<li><a href=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_movies"), "html", null, true);
        echo "\"><i class=\"icon-list-alt\"></i><span class=\"hidden-tablet\"> Movies</span></a></li>
                        <li><a href=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_movieschedule"), "html", null, true);
        echo "\"><i class=\"icon-edit\"></i><span class=\"hidden-tablet\"> Upcoming Movies</span></a></li>
                        <li><a href=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("MediaMediaBundle_search"), "html", null, true);
        echo "\"><i class=\"icon-list-alt\"></i><span class=\"hidden-tablet\"> NZB Search</span></a></li>
\t\t\t\t\t</ul>
\t\t\t\t</div><!--/.well -->
\t\t\t</div><!--/span-->
\t\t\t<!-- end: Main Menu -->
\t\t\t
\t\t\t<noscript>
\t\t\t\t<div class=\"alert alert-block span10\">
\t\t\t\t\t<h4 class=\"alert-heading\">Warning!</h4>
\t\t\t\t\t<p>You need to have <a href=\"http://en.wikipedia.org/wiki/JavaScript\" target=\"_blank\">JavaScript</a> enabled to use this site.</p>
\t\t\t\t</div>
\t\t\t</noscript>
\t\t\t
\t\t\t<div id=\"content\" class=\"span10\">
\t\t\t<!-- start: Content -->
\t\t\t
\t\t\t<div>
\t\t\t\t<ul class=\"breadcrumb\">
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"dashboard\">Home</a> <span class=\"divider\">/</span>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t";
        // line 108
        $this->displayBlock('title', $context, $blocks);
        // line 109
        echo "\t\t\t\t\t</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t\t\t\t";
        // line 112
        $this->displayBlock('content', $context, $blocks);
        // line 113
        echo "\t\t\t</div>
\t\t\t
\t\t\t\t\t<!-- end: Content -->
\t\t\t</div><!--/#content.span10-->
\t\t\t\t</div><!--/fluid-row-->
\t\t\t\t
\t\t<div class=\"modal hide fade\" id=\"myModal\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
\t\t\t\t<h3>Settings</h3>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<p>Here settings can be configured...</p>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a>
\t\t\t\t<a href=\"#\" class=\"btn btn-primary\">Save changes</a>
\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"clearfix\"></div>
\t\t<hr>
\t\t<div>
\t\t<footer>
\t\t\t<p class=\"pull-left\" style='margin-left: 30px;'>&copy; <a href=\"\" target=\"_blank\">Jonathon Bischof / John Oliver</a> 2012</p>
\t\t\t<p class=\"pull-right\" style='margin-right: 30px;'>Powered by: <a href=\"#\">Media@Home</a></p>
\t\t</footer>
\t\t</div>\t\t
\t</div><!--/.fluid-container-->
\t";
        // line 142
        $this->displayBlock('javascripts', $context, $blocks);
        // line 155
        echo "<script>
\$(document).ready(function() {

  \$(\".search\").submit(function() {
    \$.post(\$(this).attr(\"action\"), \$(this).serialize(), function(html) {
        \$(\"#searchresults\").html(html);
        \$(\"#searchresults\").show();
    });
    return false; // prevent normal submit
});

  \$(\".customspeed\").submit(function() {
    \$.post(\$(this).attr(\"action\"), \$(this).serialize(), function(html) {
        \$(\".customspeed .sabspeed\").val(\"OK!\");
\t\t\$(\".customspeed\").effect(\"bounce\", { times:3 }, 500);
\t\t\$(\".curspeed\").effect(\"highlight\", { color:'#04B404' }, 1500).effect(\"pulsate\", { times:1 }, 500).dequeue();
    });
    return false; // prevent normal submit
});

  \$(\".btn-searchtv\").click(function() {
      \$(\".tvragesearching\").slideDown('slow').effect(\"pulsate\", { times:60 }, 2000);
\t  \$(\".tvsearch-header\").html('Searching for shows...');
\t  \$(\".btn-searchtv\").html('Searching...');
\t  \$(\".btn-searchtv\").parent().effect(\"bounce\", { times:3 }, 500);
  });
  \$(\".tvragesearch\").submit(function() {
    \$.post(\$(this).attr(\"action\"), \$(this).serialize(), function(html) {
\t\t\$(\".tvragereplace\").html(html);
\t\t\$(\".tvragesearching\").stop(true, true).slideUp('slow');
\t\t\$(\".tvsearch-header\").html('Matching shows...');
\t\t\$(\".btn-searchtv\").html(\"Refine Search\").attr(\"enabled\", \"enabled\");
        \$(\".customspeed .sabspeed\").val(\"OK!\");
        \$(\".customspeed\").effect(\"bounce\", { times:3 }, 500);
        \$(\".curspeed\").effect(\"highlight\", { color:'#04B404' }, 1500).effect(\"pulsate\", { times:1 }, 500).dequeue();
    });
    return false; // prevent normal submit
});

  \$(\".tv-show\").submit(function() {
    \$.post(\$(this).attr(\"action\"), \$(this).serialize(), function(html) {
        \$(\".tvragereplace\").html(html);
        \$(\".tvragesearching\").stop(true, true).slideUp('slow');
        \$(\".tvsearch-header\").html('Matching shows...');
        \$(\".btn-searchtv\").html(\"Refine Search\").attr(\"enabled\", \"enabled\");
        \$(\".customspeed .sabspeed\").val(\"OK!\");
        \$(\".customspeed\").effect(\"bounce\", { times:3 }, 500);
        \$(\".curspeed\").effect(\"highlight\", { color:'#04B404' }, 1500).effect(\"pulsate\", { times:1 }, 500).dequeue();
    });
    return false; // prevent normal submit
});

\$(\"input[type='text']\").change( function() {
  \$(this).parent().children('.add-on').css('color', 'orange');
  \$('.changenotice').show('slow');
});
        
  \$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
  setInterval(function() {
    \$('#sabdownloads').load('/actions/sab.php?action=showdownloads').replace;
  }, [[Settings::fetch_setting('sab_refresh')]]); // the \"3000\"
  
  \$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
  setInterval(function() {
    \$('#sabhistory').load('/actions/sab.php?action=showhistory').replace;
  }, [[Settings::fetch_setting('sab_refresh')]]); // the \"3000\"

  \$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
  setInterval(function() {
    \$('#sabquickinfo').load('/actions/sab.php?action=quickinfo').replace;
  }, [[Settings::fetch_setting('sab_refresh')]]); // the \"3000\" 
});
</script>
\t
</body>
</html>
";
    }

    // line 13
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 14
        echo "    <link id=\"base-style\" href=\"css/style.css\" rel=\"stylesheet\">
\t<link id=\"base-style-responsive\" href=\"css/style-responsive.css\" rel=\"stylesheet\">
\t<link id=\"bootstrap-style\" href=\"css/bootstrap.css\" rel=\"stylesheet\">
\t<link href=\"css/bootstrap-responsive.min.css\" rel=\"stylesheet\">
\t<!-- end: CSS -->
\t";
    }

    // line 108
    public function block_title($context, array $blocks = array())
    {
        echo "<a href=\"#\">Dash</a> ";
    }

    // line 112
    public function block_content($context, array $blocks = array())
    {
        echo "[[include \"pages/\$page.tpl\"]]";
    }

    // line 142
    public function block_javascripts($context, array $blocks = array())
    {
        // line 143
        echo "\t<!-- start: JavaScript-->

\t\t<script src=\"js/jquery-1.7.2.min.js\"></script>
\t    <script src=\"js/jquery-ui-1.8.21.custom.min.js\"></script>
\t\t<script src=\"js/bootstrap.js\"></script>
\t\t<script src=\"js/jquery.cookie.js\"></script>
\t\t<script src='js/jquery.dataTables.min.js'></script>
\t\t<script src=\"js/excanvas.js\"></script>
\t\t<script src=\"js/jquery.uniform.min.js\"></script>
        <script src=\"js/jquery.noty.js\"></script>
\t\t<script src=\"js/custom.js\"></script>
\t";
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  302 => 143,  299 => 142,  293 => 112,  287 => 108,  278 => 14,  275 => 13,  195 => 155,  193 => 142,  162 => 113,  160 => 112,  155 => 109,  153 => 108,  128 => 86,  124 => 85,  120 => 84,  116 => 83,  112 => 82,  108 => 81,  104 => 80,  60 => 39,  39 => 20,  37 => 13,  23 => 1,);
    }
}
