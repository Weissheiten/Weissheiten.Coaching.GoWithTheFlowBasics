<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Model;

/*
 * This file is part of the Weissheiten.Coaching.GoWithTheFlowBasics package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @Flow\Entity
 */
class Location
{
    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     */
    protected $name;

    /**
     * @var integer
     */
    protected $zipcode;

    /**
     * The vouchers used in this location
     *
     * @ORM\OneToMany(mappedBy="location")
     * @ORM\OrderBy({"requesttime" = "DESC"})
     * @var Collection<Voucher>
     */
    protected $vouchers;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $zipcode
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     * @return void
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return Collection
     */
    public function getVouchers()
    {
        return $this->vouchers;
    }

    /**
     * @param Voucher $voucher
     */
    public function addVoucher(Voucher $voucher)
    {
        $this->vouchers->add($voucher);
    }
}