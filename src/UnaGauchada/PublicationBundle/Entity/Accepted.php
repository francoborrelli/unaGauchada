<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accepted
 *
 * @ORM\Table(name="accepted")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\AcceptedRepository")
 */
class Accepted
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
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id", nullable=true)
     */
    private $rate;


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
     * @return Accepted
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
     * Set rate
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Rate $rate
     *
     * @return Accepted
     */
    public function setRate(\UnaGauchada\PublicationBundle\Entity\Rate $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Rate
     */
    public function getRate()
    {
        return $this->rate;
    }
}
