<?php

namespace OC\LouvresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tickets
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="OC\LouvresBundle\Repository\ticketsRepository")
 */
class tickets
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
     * @ORM\ManyToOne(targetEntity="OC\LouvresBundle\Entity\booking", inversedBy="tickets", cascade="persist")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    private $booking;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="datetime")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;
    
    /**
     * @var int
     *
     * @ORM\Column(name="reduce", type="integer", nullable=true)
     */
    private $reduce;


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
     * Set idBooking
     *
     * @param integer $idBooking
     *
     * @return tickets
     */
    public function setIdBooking($idBooking)
    {
        $this->idBooking = $idBooking;

        return $this;
    }

    /**
     * Get idBooking
     *
     * @return int
     */
    public function getIdBooking()
    {
        return $this->idBooking;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return tickets
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return tickets
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return tickets
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return tickets
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set reduce
     *
     * @param integer $reduce
     *
     * @return tickets
     */
    public function setReduce($reduce)
    {
        $this->reduce = $reduce;

        return $this;
    }

    /**
     * Get reduce
     *
     * @return int
     */
    public function getReduce()
    {
        return $this->reduce;
    }

    /**
     * Set booking
     *
     * @param \OC\LouvresBundle\Entity\booking $booking
     *
     * @return tickets
     */
    public function setBooking(\OC\LouvresBundle\Entity\booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \OC\LouvresBundle\Entity\booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return tickets
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
