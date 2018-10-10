<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserve
 *
 * @ORM\Table(name="reserve")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReserveRepository")
 */
class Reserve
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
     * @var array
     *
     * @ORM\Column(name="bulk", type="simple_array", nullable=true)
     */
    private $bulk;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="reserve")
     */
    private $user;


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
     * Set bulk
     *
     * @param array $bulk
     *
     * @return Reserve
     */
    public function setBulk($bulk)
    {
        $this->bulk = $bulk;

        return $this;
    }

    /**
     * Get bulk
     *
     * @return array
     */
    public function getBulk()
    {
        return $this->bulk;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Reserve
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}

