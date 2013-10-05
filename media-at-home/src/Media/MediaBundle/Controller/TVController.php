<?php
// src/Media/MediaBundle/Controller/DownloadsController.php

namespace Media\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Media\MediaBundle\Custom\Settings;

//require_once('../src/Media/MediaBundle/Resources/includes/bootstrap.php');
class TVController extends Controller
{
    public function indexAction()
    {
        $conn = $this->get('database_connection');
        $shows = $conn->fetchAll('SELECT * from shows');
        $sitename = Settings::fetch_setting('gen_sitename', $conn);
		// Lets get the table info, and toss it in a variable. Clusterfuck incoming.

		$query = "SELECT * FROM shows";
        $results = $conn->query($query);
		$tableitems = '';
		//print_r($results);
        while ($result = $results->fetch()) {
				//var_dump($result);
            	$showid = $result['id'];
            	//$nextair = self::get_next_air_date($showid);
				$nextair = "N/A";
				$episodecount = "11000";
            	//$episodecount = self::get_episode_count($showid);
            	if ($result['active'] == 1) { $active = "<span class='label label-success'>Yes</span>"; } else { $active = "<span class='label label-important'>No</span>"; }
				$tableitems .= "<tr>";
            	$tableitems .= "<td>{$nextair}</td>";
            	$tableitems .= "<td><a href='/tv-show/?showid={$showid}'>{$result['name']}</a></td>";
            	$tableitems .= "<td>{$result['network']}</td>";
            	$tableitems .= "<td>{$result['quality']}</td>";
            	$tableitems .= "<td><span class='badge badge-info'>{$episodecount}</span></td>";
            	$tableitems .= "<td>{$active}</td>";
				$tableitems .= "</tr>";
		}

        return $this->render('MediaMediaBundle:Pages:tv-shows.html.twig',
                            array('shows' => $tableitems, 'sitename' => $sitename));
    }
	public function scheduleAction()
	{
		$conn = $this->get('database_connection');
        $sitename = Settings::fetch_setting('gen_sitename', $conn);
        return $this->render('MediaMediaBundle:Pages:tv-schedule.html.twig',
                            array('sitename' => $sitename));
	}
}
