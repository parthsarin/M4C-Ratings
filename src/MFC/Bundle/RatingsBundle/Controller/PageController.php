<?php

namespace MFC\Bundle\RatingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PageController extends Controller
{
	/**
	 * @Route("/", name="page_index")
	 * @Method("GET")
	 * @Template
	 */
	public function indexAction()
	{
		return array();
	}
}