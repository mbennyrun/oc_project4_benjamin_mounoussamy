<?php

namespace OC\LouvresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OC\LouvresBundle\Validator\ClosedDay;
use OC\LouvresBundle\Validator\PublicHoliday;

/**
 * booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="OC\LouvresBundle\Repository\bookingRepository")
 */
class booking
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
     * @Assert\DateTime
     * @ClosedDay()
     * @PublicHoliday()
     *
     * @ORM\Column(name="booking_date", type="datetime")
     */
    private $bookingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="total_price", type="float")
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     *
     * @var integer
     * 
     * @ORM\Column(name="tickets_number", type="integer")
     */
    private $ticketsNumber;
    /**
     * @var string
     *
     * @ORM\Column(name="booking_code", type="string", length=255)
     */
    private $bookingCode;

    /**
    *
     * @ORM\OneToMany(targetEntity="OC\LouvresBundle\Entity\tickets", mappedBy="booking", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="Tickets")
     *
     */
    private $tickets;

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
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     *
     * @return booking
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return booking
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return booking
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return booking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bookingCode
     *
     * @param string $bookingCode
     *
     * @return booking
     */
    public function setBookingCode($bookingCode)
    {
        $this->bookingCode = $bookingCode;

        return $this;
    }

    /**
     * Get bookingCode
     *
     * @return string
     */
    public function getBookingCode()
    {
        return $this->bookingCode;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \OC\LouvresBundle\Entity\tickets $ticket
     *
     * @return booking
     */
    public function addTicket(\OC\LouvresBundle\Entity\tickets $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \OC\LouvresBundle\Entity\tickets $ticket
     */
    public function removeTicket(\OC\LouvresBundle\Entity\tickets $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set ticketsNumber
     *
     * @param integer $ticketsNumber
     *
     * @return booking
     */
    public function setTicketsNumber($ticketsNumber)
    {
        $this->ticketsNumber = $ticketsNumber;

        return $this;
    }

    /**
     * Get ticketsNumber
     *
     * @return integer
     */
    public function getTicketsNumber()
    {
        return $this->ticketsNumber;
    }
    
    public function isClosed($weekDays) 
    {
        $closedDays = array('tuesday', 'sunday');
        
        if (preg_match('#'.implode('|', $closedDays).'#', $this->getContent())) {
      // La règle est violée, on définit l'erreur
      $context
        ->atPath('content')                                                   // attribut de l'objet qui est violé
        ->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
      ;
    }
        
    }
}
