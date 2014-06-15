<?php

namespace MFC\Bundle\RatingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

use MFC\Bundle\RatingsBundle\Entity\Maplet;

/**
 * StudentRating
 *
 * @ORM\Table(name="studentRatings")
 * @ORM\Entity
 */
class StudentRating
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="timeEval", type="string", length=255)
     * @Assert\NotBlank(
     *     message="You must answer this question."
     * )
     */
    private $timeEval;

    /**
     * @var string
     *
     * @ORM\Column(name="learnt", type="string", length=255)
     * @Assert\NotBlank(
     *     message="You must answer this question."
     * )
     */
    private $learnt;

    /**
     * @var string
     *
     * @ORM\Column(name="usefulPast", type="string", length=255, nullable=true)
     */
    private $usefulPast;

    /**
     * @var string
     *
     * @ORM\Column(name="usefulFuture", type="string", length=255, nullable=true)
     */
    private $usefulFuture;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="Maplet")
     * @ORM\JoinColumn(name="maplet_id", referencedColumnName="id")
     */
    private $maplet;

    /**
     * Construct the entity
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->timeEval = 'before';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set timeEval
     *
     * @param string $timeEval
     * @return StudentRating
     */
    public function setTimeEval($timeEval)
    {
        $this->timeEval = $timeEval;

        return $this;
    }

    /**
     * Get timeEval
     *
     * @return string 
     */
    public function getTimeEval()
    {
        return $this->timeEval;
    }

    /**
     * Set learnt
     *
     * @param string $learnt
     * @return StudentRating
     */
    public function setLearnt($learnt)
    {
        $this->learnt = $learnt;

        return $this;
    }

    /**
     * Get learnt
     *
     * @return string 
     */
    public function getLearnt()
    {
        return $this->learnt;
    }

    /**
     * Set usefulPast
     *
     * @param string $usefulPast
     * @return StudentRating
     */
    public function setUsefulPast($usefulPast)
    {
        $this->usefulPast = $usefulPast;

        return $this;
    }

    /**
     * Get usefulPast
     *
     * @return string 
     */
    public function getUsefulPast()
    {
        return $this->usefulPast;
    }

    /**
     * Set usefulFuture
     *
     * @param string $usefulFuture
     * @return StudentRating
     */
    public function setUsefulFuture($usefulFuture)
    {
        $this->usefulFuture = $usefulFuture;

        return $this;
    }

    /**
     * Get usefulFuture
     *
     * @return string 
     */
    public function getUsefulFuture()
    {
        return $this->usefulFuture;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return StudentRating
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return StudentRating
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Validate the entity.
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        $timeTaken = $this->getTimeEval();

        if ($timeTaken == "before") {
            // Validate UsefulFuture
            $usefulFuture = $this->getUsefulFuture();

            if (!$usefulFuture || rtrim($usefulFuture) == "") {
                $context->addViolationAt(
                    'usefulFuture',
                    'You must answer this question.',
                    array(),
                    null
                );
            }
        } else {
            // Validate UsefulPast
            $usefulPast = $this->getUsefulPast();

            if (!$usefulPast || rtrim($usefulPast) == "") {
                $context->addViolationAt(
                    'usefulPast',
                    'You must answer this question.',
                    array(),
                    null
                );
            }
        }
    }

    /**
     * Set maplet
     *
     * @param string $maplet
     * @return StudentRating
     */
    public function setMaplet($maplet)
    {
        $this->maplet = $maplet;

        return $this;
    }

    /**
     * Get maplet
     *
     * @return string 
     */
    public function getMaplet()
    {
        return $this->maplet;
    }
}
