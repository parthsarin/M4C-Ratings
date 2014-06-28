<?php

namespace MFC\Bundle\RatingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

use MFC\Bundle\RatingsBundle\Entity\Maplet;
use MFC\Bundle\RatingsBundle\Entity\Person;

use MFC\Bundle\RatingsBundle\Form\PersonType;

class PageController extends Controller
{
        /**
         * @Route("/{version}/{slug}/1", name="page_maplet_1")
         * @Method("GET|POST")
         * @Template("MFCRatingsBundle:Rate:gateway.html.twig")
         */
        public function studentInstructorAction(Maplet $maplet, Request $request, $version)
        {
                // $person = new Person();
 
                // $form = $this->createStudentInstructorForm($person, $maplet);
 
                // if ($request->getMethod() == "POST") {
                //      $form->handleRequest($request);
 
                //      if ($form->isValid()) {
                //              $role = $person->getRole();
 
                //              if ($role == "student") {
                //                      return $this->redirect($this->generateUrl('page_maplet_2', array('role' => 'student', 'slug' => $maplet->getSlug())));
                //              } else {
                //                      return $this->redirect($this->generateUrl('page_maplet_2', array('role' => 'instructor', 'slug' => $maplet->getSlug())));
                //              }
                //      }
                // }
 
                // $form = $form->createView();
 
                // return compact( 'form', 'maplet' );
 
                if (null == $request->cookies->get('MFC_ROLE'))
                {
                        $backtrack = "page_maplet_2";
                        return compact('maplet', 'backtrack', 'version');
                }
 
                $slug = $maplet->getSlug();
                return $this->redirect($this->generateUrl('page_maplet_3', compact('slug', 'version')));
        }

	/**
	 * @Route("/{version}", name="page_index")
	 * @Method("GET")
	 * @Template
	 */
	public function indexAction(Request $request, $version)
	{
		if (null == $request->cookies->get('MFC_ROLE'))
		{
			return $this->render('MFCRatingsBundle:Rate:gateway.html.twig', array('backtrack' => 'page_index', 'version' => $version));
		}

		$em = $this->getDoctrine()->getManager();

		$maplets = $em->getRepository('MFCRatingsBundle:Maplet')->findAll();

		return compact('maplets', 'version');
	}

	/**
	 * @Route("/set_cookie/{role}/{backtrack}/{version}", name="set_role_cookie")
	 * @Method("GET")
	 */
	public function setCookieForRole($role, $backtrack, $version)
	{
		setcookie('MFC_ROLE', $role, time() + (10 * 365 * 24 * 60 * 60), '/');
		return $this->redirect($this->generateUrl($backtrack, compact('version')));
	}

	/**
	 * @Route("/set_cookie/{role}/{backtrack}/{slug}/{version}", name="set_role_cookie_slug")
	 * @Method("GET")
	 */
	public function setCookieForRoleSlug($role, $backtrack, $slug, $version)
	{
		setcookie('MFC_ROLE', $role, time() + (10 * 365 * 24 * 60 * 60), '/');
		return $this->redirect($this->generateUrl($backtrack, compact('slug', 'version')));
	}

	/**
	 * @Route("/gateway/{version}", name="page_gateway")
	 * @Method("GET")
	 * @Template("MFCRatingsBundle:Rate:gateway.html.twig")
	 */
	public function loadGateway($version)
	{
		$backtrack = "page_index";
		return compact('backtrack', 'version');
	}

	/**
	 * @Route("/thanks", name="page_thanks")
	 * @Method("GET")
	 * @Template
	 */
	public function thanksAction()
	{
		return array();
	}
}
