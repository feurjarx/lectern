<?php
/**
 * Created by PhpStorm.
 * Date: 26.04.2016
 * Time: 23:04
 */

namespace Entity;

use Doctrine\ORM\PersistentCollection;

/**
 * @Entity @Table(name="user")
 **/
class User
{
    public function __construct()
    {
        $this->createdAt = time();
    }

    /** @Id @Column(name="id", type="integer") @GeneratedValue **/
    private $id;

    /** @Column(name="first_name", type="string") **/
    private $firstName;

    /** @Column(name="last_name", type="string") **/
    private $lastName;

    /** @Column(name="email", type="string") **/
    private $email;

    /** @Column(name="password", type="string") **/
    private $password = '';

    /** @Column(name="role", type="string") **/
    private $role;

    /** @Column(name="created_at", type="integer") **/
    private $createdAt;

    /** @Column(name="img_url", type="string") **/
    private $imgUrl = null;

    /** @Column(name="company", type="string") **/
    private $company;

    /**
     * @OneToMany(targetEntity="Ad", mappedBy="user")
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @param mixed $imgUrl
     */
    public function setimgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
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

    /**
     * @return string
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
}