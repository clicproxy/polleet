<?php

namespace Clicproxy\PolleetBundle\Controller;

use Clicproxy\PolleetBundle\Entity\Answer;
use Clicproxy\PolleetBundle\Entity\Person;
use Clicproxy\PolleetBundle\Entity\Poll;
use Clicproxy\PolleetBundle\Entity\PollAnswer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/link/{poll_slug}/{poll_answer_slug}/{email}/{name}", name="link")
     * @Template()
     *
     * @param $poll_slug
     * @param $poll_answer_slug
     * @param $email
     * @param null $name
     */
    public function linkAction($poll_slug, $poll_answer_slug, $email, $name = null)
    {
        $em = $this->getDoctrine()->getManager();
        // Find Poll
        $poll = $em->getRepository('ClicproxyPolleetBundle:Poll')->findOneBy(array('slug' => $poll_slug));

        if (!$poll instanceof Poll) throw $this->createNotFoundException('Unable to find Poll');

        // Find PollAnswer
        $poll_answer = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->findOneBy(array('slug' => $poll_answer_slug));

        if (!$poll_answer instanceof PollAnswer) throw $this->createNotFoundException('Unable to find PollAnswer');

        // Find Person
        $person = $em->getRepository('ClicproxyPolleetBundle:Person')->findOneBy(array('email' => $email));

        if ($person instanceof Person) {
            if (null != $name && $name != $person->getName()) {
                $person->setName($name);
                $em->flush();
            }
        } else {
            $person = new Person();
            $person->setEmail($email);
            $person->setName($name);
            $em->persist($person);
            $em->flush();
        }

        $answer = $em->getRepository('ClicproxyPolleetBundle:Answer')->findOneBy(array('poll' => $poll, 'person' => $person));
        if ($answer instanceof Answer) {
            $answer->setPollAnswer($poll_answer);
        } else {
            // Create Answer
            $answer = new Answer();
            $answer->setPoll($poll);
            $answer->setPollAnswer($poll_answer);
            $answer->setPerson($person);
            $em->persist($answer);
        }
        $em->flush();

        return $this->redirect($this->generateUrl('thanks', array('slug' => $poll->getSlug())));
    }

    /**
     * @Route("/thanks/{slug}", name="thanks")
     * @Template()
     *
     * @param $slug
     */
    public function thanksAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        // Find Poll
        $poll = $em->getRepository('ClicproxyPolleetBundle:Poll')->findOneBy(array('slug' => $slug));

        if (!$poll instanceof Poll) throw $this->createNotFoundException('Unable to find Poll');

        return array('poll' => $poll);
    }
}
