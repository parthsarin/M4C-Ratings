<?php

namespace MFC\Bundle\RatingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;

use MFC\Bundle\RatingsBundle\Entity\Maplet;
use MFC\Bundle\RatingsBundle\Entity\Person;
use MFC\Bundle\RatingsBundle\Entity\StudentRating;
use MFC\Bundle\RatingsBundle\Entity\InstructorRating;

use MFC\Bundle\RatingsBundle\Form\PersonType;
use MFC\Bundle\RatingsBundle\Form\StudentRatingType;
use MFC\Bundle\RatingsBundle\Form\InstructorRatingType;

class RateController extends Controller
{
	/**
	 * @Route("/{version}/{slug}", name="page_maplet_3")
	 * @Method("GET")
	 */
	public function finalAction(Maplet $maplet, Request $request, $version)
	{
		if (null == $request->cookies->get('MFC_ROLE'))
		{
			return $this->render('MFCRatingsBundle:Rate:gateway.html.twig', array('maplet' => $maplet,'backtrack' => 'page_maplet_1', 'slug' => $maplet->getSlug(), 'version' => $version));
		}

		$role = $request->cookies->get("MFC_ROLE");

		if ($role != "student" and $role != "instructor") {
			return $this->redirect($this->generateUrl('page_index'));
		}

		if ($role == "student") {
			$studentRating = new StudentRating();
			$studentRating->setMaplet($maplet);
			$form = $this->createStudentRatingForm($studentRating)->createView();

			return $this->render('MFCRatingsBundle:Rate:student.html.twig', compact('maplet', 'form', 'version'));
		} else {
			$instructorRating = new InstructorRating();
			$instructorRating->setMaplet($maplet);
			$form = $this->createInstructorRatingForm($instructorRating)->createView();

			return $this->render('MFCRatingsBundle:Rate:instructor.html.twig', compact('maplet', 'form', 'version'));
		}
	}

	/**
	 * @Route("/{version}/{slug}/error", name="maplet_final_submit_student")
	 * @Method("POST")
	 */
	public function mapletStudentSubmitAction(Maplet $maplet, Request $request, $version)
	{
		$studentRating = new StudentRating();
		$studentRating->setMaplet($maplet);
		$form = $this->createStudentRatingForm($studentRating);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

                        $studentRating->setVersion($version);

			$em->persist($studentRating);
			$em->flush();

			// $this->get('session')->getFlashBag()->add('notice-success', 'The rating was successfully submitted! Click to dismiss.');
			return $this->redirect($this->generateUrl('page_thanks'));
		}

		$form = $form->createView();

		return $this->render('MFCRatingsBundle:Rate:student.html.twig', compact('maplet', 'form'));
	}

	/**
	 * @Route("/{slug}/finish/error", name="maplet_final_submit_instructor")
	 * @Method("POST")
	 * @Template("MFCRatingsBundle:Rate:instructor.html.twig")
	 */
	public function mapletInstructorSubmitAction(Maplet $maplet, Request $request)
	{
		$instructorRating = new InstructorRating();
		$instructorRating->setMaplet($maplet);
		$form = $this->createInstructorRatingForm($instructorRating);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

                        $instructorRating->setVersion($version);

			$em->persist($instructorRating);
			$em->flush();

			// $this->get('session')->getFlashBag()->add('notice-success', 'The rating was successfully submitted! Click to dismiss.');
			return $this->redirect($this->generateUrl('page_thanks'));
		}

		$form = $form->createView();
		return compact('maplet', 'form');
	}

	/**
	 * Create a Student Rating form.
	 *
	 * @param StudentRating $studentRating "The student rating to create a form for."
	 * @return Form "The form to render and display"
	 */
	public function createStudentRatingForm(StudentRating $studentRating)
	{
		$form = $this->createForm(new StudentRatingType(), $studentRating, array(
			'method' => 'POST',
			'action' => $this->generateUrl('maplet_final_submit_student', array('slug' => $studentRating->getMaplet()->getSlug())),
			'attr' => array(
				'novalidate' => true,
			),
		));

		$form->add('submit', 'submit', array('attr' => array('class' => 'btn btn-default btn-success')));

		return $form;
	}

	/**
	 * Create an Instructor Rating form.
	 *
	 * @param InstructorRating $instructorRating "The instructor rating to create a form for."
	 * @return Form "The form to render and display"
	 */
	public function createInstructorRatingForm(InstructorRating $instructorRating)
	{
		$form = $this->createForm(new InstructorRatingType(), $instructorRating, array(
			'method' => 'POST',
			'action' => $this->generateUrl('maplet_final_submit_instructor', array('slug' => $instructorRating->getMaplet()->getSlug())),
			'attr' => array(
				'novalidate' => true,
			),
		));

		$form->add('submit', 'submit', array('attr' => array('class' => 'btn btn-default btn-success')));

		return $form;
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
