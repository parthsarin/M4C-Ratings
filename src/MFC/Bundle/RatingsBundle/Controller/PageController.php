<?php

namespace MFC\Bundle\RatingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;

use MFC\Bundle\RatingsBundle\Entity\Maplet;
use MFC\Bundle\RatingsBundle\Entity\Person;

use MFC\Bundle\RatingsBundle\Form\PersonType;

class PageController extends Controller
{
	/**
	 * @Route("/", name="page_index")
	 * @Method("GET")
	 * @Template
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$maplets = $em->getRepository('MFCRatingsBundle:Maplet')->findAll();

		return compact('maplets');
	}
}