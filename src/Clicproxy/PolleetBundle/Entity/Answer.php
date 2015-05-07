<?php

namespace Clicproxy\PolleetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Answer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Clicproxy\PolleetBundle\Entity\AnswerRepository")
 * @UniqueEntity({"person", "poll"})
 */
class Answer
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getPoll()->getSlug() . '/' . $this->getPerson();
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
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="answers")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    private $poll;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="answers")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="PollAnswer", inversedBy="answers")
     * @ORM\JoinColumn(name="pollanswer_id", referencedColumnName="id")
     */
    private $poll_answer;


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
     * Set poll
     *
     * @param \Clicproxy\PolleetBundle\Entity\Poll $poll
     * @return Answer
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
     * Set person
     *
     * @param \Clicproxy\PolleetBundle\Entity\Person $person
     * @return Answer
     */
    public function setPerson(\Clicproxy\PolleetBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Clicproxy\PolleetBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set poll_answer
     *
     * @param \Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswer
     * @return Answer
     */
    public function setPollAnswer(\Clicproxy\PolleetBundle\Entity\PollAnswer $pollAnswer = null)
    {
        $this->poll_answer = $pollAnswer;

        return $this;
    }

    /**
     * Get poll_answer
     *
     * @return \Clicproxy\PolleetBundle\Entity\PollAnswer 
     */
    public function getPollAnswer()
    {
        return $this->poll_answer;
    }
}
