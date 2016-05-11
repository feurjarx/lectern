<?php
/**
 * Created by PhpStorm.
 * Date: 26.04.2016
 * Time: 23:04
 */

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

require_once __DIR__ . '/../entity/Company.php';
require_once __DIR__ . '/../entity/Ad.php';

/**
 * @Entity @Table(name="company")
 **/
class Company
{
    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    /** @Id @Column(name="id", type="integer") @GeneratedValue **/
    private $id;

    /** @Column(name="name", type="string") **/
    private $name;

    /** @Column(name="address", type="string") **/
    private $address;

    /**
     * @var PersistentCollection
     * @OneToMany(targetEntity="Ad", mappedBy="company")
     */
    private $ads;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param PersistentCollection $ads
     * @return $this
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
        return $this;
    }
}