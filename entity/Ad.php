<?php
/**
 * Created by PhpStorm.
 * Date: 26.04.2016
 * Time: 23:04
 */

namespace Entity;

use Doctrine\Common\Proxy\Proxy;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="ad")
 **/
class Ad
{
    /**
     * Ad constructor.
     */
    public function __construct()
    {
        $this->publishedAt = time();
    }
    /** @Id @Column(name="id", type="integer") @GeneratedValue **/
    private $id;

    /** @Column(name="name", type="string") **/
    private $name;

    /** @Column(name="published_at", type="integer") **/
    private $publishedAt;

    /** @Column(name="salary", type="integer") **/
    private $salary;

    /** @Column(name="details", type="string") **/
    private $details;

    /**
     * @var Company
     *
     * @ManyToOne(targetEntity="Company", cascade={"persist", "remove"})
     * @JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     * @return $this
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}