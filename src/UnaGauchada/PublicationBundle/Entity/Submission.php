<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UnaGauchada\PublicationBundle\Model\WaitingState;
use UnaGauchada\UserBundle\Entity\User;

/**
 * Submission
 *
 * @ORM\Table(name="submission")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\SubmissionRepository")
 */
class Submission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="UnaGauchada\UserBundle\Entity\User", inversedBy="submissions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="submissions")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="AcceptedState", mappedBy="submission", cascade={"persist"})
     */
    private $acceptedState;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    protected $message;


    public function __construct(User $user, Publication $publication){
        $this->setUser($user);
        $this->setPublication($publication);
        $this->setDate(new \DateTime());
        $publication->addSubmission($this);
        $user->addSubmission($this);
    }

    public function getState(){
        if($this->acceptedState == null){
            return new WaitingState($this);
        }else{
            return $this->getAcceptedState();
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Submission
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \UnaGauchada\UserBundle\Entity\User $user
     *
     * @return Submission
     */
    public function setUser(\UnaGauchada\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UnaGauchada\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set publication
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Publication $publication
     *
     * @return Submission
     */
    public function setPublication(\UnaGauchada\PublicationBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set acceptedState
     *
     * @param \UnaGauchada\PublicationBundle\Entity\AcceptedState $acceptedState
     *
     * @return Submission
     */
    public function setAcceptedState(\UnaGauchada\PublicationBundle\Entity\AcceptedState $acceptedState = null)
    {
        $this->acceptedState = $acceptedState;

        return $this;
    }

    /**
     * Get acceptedState
     *
     * @return \UnaGauchada\PublicationBundle\Entity\AcceptedState
     */
    public function getAcceptedState()
    {
        return $this->acceptedState;
    }

    public function getScore(){
        return $this->getState()->getScore();
    }


    /**
     * Set message
     *
     * @param string $message
     *
     * @return Submission
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function isChosen(){
        return $this->getState()->isChosen();
    }

    public function hasScore(){
        return $this->getState()->getRate();
    }

    public function isWaiting(){
        return $this->getState()->isWaiting($this->getPublication());
    }

    public function isRejected(){
        return $this->getState()->isRejected($this->getPublication());
    }

    public function getScoreMessage(){
        return $this->getState()->getScoreMessage();
    }

}
