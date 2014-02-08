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

class RateController extends Controller
{
	/**
	 * @Route("/{slug}/1", name="page_maplet_1")
	 * @Method("GET|POST")
	 * @Template("MFCRatingsBundle:Rate:student_instructor.html.twig")
	 */
	public function studentInstructorAction(Maplet $maplet, Request $request)
	{
		$person = new Person();

		$form = $this->createStudentInstructorForm($person, $maplet);

		if ($request->getMethod() == "POST") {
			$form->handleRequest($request);

			if ($form->isValid()) {
				$role = $person->getRole();

				if ($role == "student") {
					return $this->redirect($this->generateUrl('page_maplet_2', array('role' => 'student', 'slug' => $maplet->getSlug())));
				} else {
					return $this->redirect($this->generateUrl('page_maplet_2', array('role' => 'instructor', 'slug' => $maplet->getSlug())));
				}
			}
		}

		$form = $form->createView();

		return compact( 'form', 'maplet' );
	}

	/**
	 * @Route("/{slug}/{role}/2", name="page_maplet_2")
	 * @Method("GET")
	 * @Template("MFCRatingsBundle:Rate:legal.html.twig")
	 */
	public function legalAction(Maplet $maplet, $role)
	{
		if ($role != "student" and $role != "instructor") {
			return $this->redirect($this->generateUrl('page_index'));
		}
		return compact('maplet', 'role');
	}

	/**
	 * @Route("/{slug}/{role}/3", name="page_maplet_3")
	 * @Method("GET")
	 */
	public function finalAction(Maplet $maplet, $role)
	{
		if ($role != "student" and $role != "instructor") {
			return $this->redirect($this->generateUrl('page_index'));
		}	
		if ($role == "student") {
			$studentRating = new StudentRating();
			$form = $this->createStudentRatingForm($studentRating);

			return $this->render('MFCRatingsBundle:Rate:student.html.twig', compact('maplet', 'form'));
		} else {
			$instructorRating = new InstructorRating();
			$form = $this->createInstructorRatingForm($instructorRating);

			return $this->render('MFCRatingsBundle:Rate:instructor.html.twig', compact('maplet', 'form'));
		}
	}

	/**
	 * Create a "Student or Instructor" form
	 *
	 * @param Person $person "The person to generate a form for."
	 * @param Maplet $maplet "The maplet used to generate a slug for the action."
	 * @return Form "The form to display"
	 */
	public function createStudentInstructorForm(Person $person, Maplet $maplet)
	{
		$form = $this->createForm(new PersonType(), $person, array(
			'method' => 'POST',
			'action' => $this->generateUrl('page_maplet_1', array('slug' => $maplet->getSlug())),
		));

		$form->add('continue', 'submit', array('attr' => array('class' => 'btn btn-default')));

		return $form;
	}
}