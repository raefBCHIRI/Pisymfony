<?php

namespace CircuitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity(repositoryClass="CircuitsBundle\Repository\CircuitRepository")
 */
class Circuit
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=50)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="pause", type="string", length=50)
     */
    private $pause;

    /**
     * @var string
     *
     * @ORM\Column(name="end", type="string", length=50)
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="string", length=20)
     */
    private $difficulty;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Circuit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set depart
     *
     * @param string $depart
     *
     * @return Circuit
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set pause
     *
     * @param string $pause
     *
     * @return Circuit
     */
    public function setPause($pause)
    {
        $this->pause = $pause;

        return $this;
    }

    /**
     * Get pause
     *
     * @return string
     */
    public function getPause()
    {
        return $this->pause;
    }

    /**
     * Set end
     *
     * @param string $end
     *
     * @return Circuit
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set difficulty
     *
     * @param string $difficulty
     *
     * @return Circuit
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return string
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }
}

