<?php
// src/Media/MediaBundle/Controller/MediaController.php

namespace Media\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Media\MediaBundle\Custom\Settings;

//require_once('../src/Media/MediaBundle/Resources/includes/bootstrap.php');
class MovieController extends Controller
{
    public function indexAction()
    {
		$conn = $this->get('database_connection');
		$sitename = Settings::fetch_setting('gen_sitename', $conn);
        return $this->render('MediaMediaBundle:Pages:movies.html.twig',
							array('sitename' => $sitename));
    }
    public function scheduleAction()
    {
        $conn = $this->get('database_connection');
        $sitename = Settings::fetch_setting('gen_sitename', $conn);
        return $this->render('MediaMediaBundle:Pages:movie-schedule.html.twig',
                            array('sitename' => $sitename));
    }
}
