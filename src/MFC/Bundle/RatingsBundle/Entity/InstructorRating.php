<?php

namespace MFC\Bundle\RatingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

use MFC\Bundle\RatingsBundle\Entity\Maplet;

/**
 * InstructorRating
 *
 * @ORM\Table(name="instructorRatings")
 * @ORM\Entity
 */
class InstructorRating
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
     * @var array
     *
     * @ORM\Column(name="methodUsed", type="array", nullable=true)
     */
    private $methodUsed;

    /**
     * @var string
     *
     * @ORM\Column(name="methodUsedOther", type="text", nullable=true)
     */
    private $methodUsedOther;

    /**
     * @var array
     *
     * @ORM\Column(name="skillsDeveloped", type="array", nullable=true)
     */
    private $skillsDeveloped;

    /**
     * @var string
     *
     * @ORM\Column(name="skillsDevelopedOther", type="text", nullable=true)
     */
    private $skillsDevelopedOther;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", length=255)
     * @Assert\NotBlank(
     *     message="You must answer this question."
     * )
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var \DateTime
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
     * Set methodUsed
     *
     * @param string $methodUsed
     * @return InstructorRating
     */
    public function setMethodUsed($methodUsed)
    {
        $this->methodUsed = $methodUsed;

        return $this;
    }

    /**
     * Get methodUsed
     *
     * @return string 
     */
    public function getMethodUsed()
    {
        return $this->methodUsed;
    }

    /**
     * Set methodUsedOther
     *
     * @param string $methodUsedOther
     * @return InstructorRating
     */
    public function setMethodUsedOther($methodUsedOther)
    {
        $this->methodUsedOther = $methodUsedOther;

        return $this;
    }

    /**
     * Get methodUsedOther
     *
     * @return string 
     */
    public function getMethodUsedOther()
    {
        return $this->methodUsedOther;
    }

    /**
     * Set skillsDeveloped
     *
     * @param string $skillsDeveloped
     * @return InstructorRating
     */
    public function setSkillsDeveloped($skillsDeveloped)
    {
        $this->skillsDeveloped = $skillsDeveloped;

        return $this;
    }

    /**
     * Get skillsDeveloped
     *
     * @return string 
     */
    public function getSkillsDeveloped()
    {
        return $this->skillsDeveloped;
    }

    /**
     * Set skillsDevelopedOther
     *
     * @param string $skillsDevelopedOther
     * @return InstructorRating
     */
    public function setSkillsDevelopedOther($skillsDevelopedOther)
    {
        $this->skillsDevelopedOther = $skillsDevelopedOther;

        return $this;
    }

    /**
     * Get skillsDevelopedOther
     *
     * @return string 
     */
    public function getSkillsDevelopedOther()
    {
        return $this->skillsDevelopedOther;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return InstructorRating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return InstructorRating
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
     * @param \DateTime $created
     * @return InstructorRating
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set maplet
     *
     * @param \MFC\Bundle\RatingsBundle\Entity\Maplet $maplet
     * @return InstructorRating
     */
    public function setMaplet(\MFC\Bundle\RatingsBundle\Entity\Maplet $maplet = null)
    {
        $this->maplet = $maplet;

        return $this;
    }

    /**
     * Get maplet
     *
     * @return \MFC\Bundle\RatingsBundle\Entity\Maplet 
     */
    public function getMaplet()
    {
        return $this->maplet;
    }

    /**
     * Validate the entity
     *
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        $methodUsed = $this->getMethodUsed();
        $methodUsedOther = $this->getMethodUsedOther();

        if ((!$methodUsed || empty($methodUsed)) and (!$methodUsedOther || rtrim($methodUsedOther) == "")) {
            $context->addViolationAt(
                'methodUsed',
                'You must answer this question.',
                array(),
                null
            );
        }

        $skillsDeveloped = $this->getSkillsDeveloped();
        $skillsDevelopedOther = $this->getSkillsDevelopedOther();

        if ((!$skillsDeveloped || empty($skillsDeveloped) and (!$skillsDevelopedOther || rtrim($skillsDevelopedOther == "")))) {
            $context->addViolationAt(
                'skillsDeveloped',
                'You must answer this question.',
                array(),
                null
            );
        }
    }
}
