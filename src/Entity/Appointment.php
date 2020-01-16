<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="appointment", cascade={"persist"})
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="appointment", cascade={"persist"})
     */
    private $Customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="appointment", cascade={"persist"})
     */
    private $Place;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $user): self
    {
        $this->User = $user;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->Customer = $customer;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $place): self
    {
        $this->Place = $place;

        return $this;
    }

    public function getDate(): ?DateTimeInterface 
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
