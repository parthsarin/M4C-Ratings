<?php

namespace MFC\Bundle\RatingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * StudentRating
 *
 * @ORM\Table()
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
     */
    private $timeEval;

    /**
     * @var string
     *
     * @ORM\Column(name="learnt", type="string", length=255)
     */
    private $learnt;

    /**
     * @var string
     *
     * @ORM\Column(name="usefulPast", type="string", length=255)
     */
    private $usefulPast;

    /**
     * @var string
     *
     * @ORM\Column(name="usefulFuture", type="string", length=255)
     */
    private $usefulFuture;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * Construct the entity
     */
    public function __construct()
    {
        $this->creted = new \DateTime();
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
     */
    public function validate(ExecutionContextInterface $context)
    {
        $timeTaken = $this->getTimeEval();

        if ($timeTaken == "Before") {
            // Validate UsefulFuture
            $usefulFuture = $this->getUsefulFuture();
            
            if (rtrim($usefulFuture) == "") {
                $context->addViolationAt(
                    'usefulFuture',
                    'This value cannot be blank.',
                    array(),
                    null
                );
            }
        } else {
            // Validate UsefulPast
            $usefulPast = $this->getUsefulPast();

            if (rtrim($usefulPast) == "") {
                $context->addViolationAt(
                    'usefulPast',
                    'This value cannot be blank.',
                    array(),
                    null
                );
            }
        }
    }
}
