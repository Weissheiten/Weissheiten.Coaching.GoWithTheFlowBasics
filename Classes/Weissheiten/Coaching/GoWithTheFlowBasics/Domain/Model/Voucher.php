<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Model;

/*
 * This file is part of the Weissheiten.Coaching.GoWithTheFlowBasics package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Voucher
{
    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     */
    protected $username;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=7, "maximum"=7 })
     */
    protected $password;

    /**
     * @var integer
     */
    protected $validitymin;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $requesttime;

    /**
     * @ORM\ManyToOne(inversedBy="vouchers")
     * @var Location
     */
    protected $location;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return integer
     */
    public function getValiditymin()
    {
        return $this->validitymin;
    }

    /**
     * @param integer $validitymin
     * @return void
     */
    public function setValiditymin($validitymin)
    {
        $this->validitymin = $validitymin;
    }

    /**
     * @return \DateTime
     */
    public function getRequesttime()
    {
        return $this->requesttime;
    }

    /**
     * @param \DateTime $date
     * @return void
     */
    public function setRequesttime(\DateTime $date)
    {
        $this->requesttime = $date;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}