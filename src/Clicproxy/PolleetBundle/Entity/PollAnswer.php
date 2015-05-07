<?php

namespace Clicproxy\PolleetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PollAnswer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Clicproxy\PolleetBundle\Entity\PollAnswerRepository")
 * @UniqueEntity({"slug", "poll"})
 */
class PollAnswer
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getAnswer();
    }

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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="poll_answers")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    private $poll;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="poll_answer")
     */
    private $answers;


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
     * Set slug
     *
     * @param string $slug
     * @return PollAnswer
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return PollAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set poll
     *
     * @param \Clicproxy\PolleetBundle\Entity\Poll $poll
     * @return PollAnswer
     */
    public function setPoll(\Clicproxy\PolleetBundle\Entity\Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \Clicproxy\PolleetBundle\Entity\Poll 
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Add answers
     *
     * @param \Clicproxy\PolleetBundle\Entity\Answer $answers
     * @return PollAnswer
     */
    public function addAnswer(\Clicproxy\PolleetBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Clicproxy\PolleetBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Clicproxy\PolleetBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
