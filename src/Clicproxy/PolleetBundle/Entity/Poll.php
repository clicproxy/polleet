<?php

namespace Clicproxy\PolleetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Poll
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Clicproxy\PolleetBundle\Entity\PollRepository")
 */
class Poll
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getQuestion();
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
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date")
     */
    private $end;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="countdown", type="date")
     */
    private $countdown;

    /**
     * @ORM\OneToMany(targetEntity="PollAnswer", mappedBy="poll")
     */
    private $poll_answers;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="poll")
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
     * @return Poll
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
     * Set question
     *
     * @param string $question
     * @return Poll
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Poll
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set countdown
     *
     * @param \DateTime $countdown
     * @return Poll
     */
    public function setCountdown($countdown)
    {
        $this->countdown = $countdown;

        return $this;
    }

    /**
     * Get countdown
     *
     * @return \DateTime 
     */
    public function getCountdown()
    {
        return $this->countdown;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->poll_answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add poll_answers
     *
     * @param \Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswers
     * @return Poll
     */
    public function addPollAnswer(\Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswers)
    {
        $this->poll_answers[] = $pollAnswers;

        return $this;
    }

    /**
     * Remove poll_answers
     *
     * @param \Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswers
     */
    public function removePollAnswer(\Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswers)
    {
        $this->poll_answers->removeElement($pollAnswers);
    }

    /**
     * Get poll_answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPollAnswers()
    {
        return $this->poll_answers;
    }

    /**
     * Add answers
     *
     * @param \Clicproxy\PolleetBundle\Entity\Answer $answers
     * @return Poll
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
