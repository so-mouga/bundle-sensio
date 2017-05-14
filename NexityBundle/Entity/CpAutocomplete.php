<?php

namespace SL\NexityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CpAutocomplete
 *
 * @ORM\Table(name="cp_autocomplete")
 * @ORM\Entity
 */
class CpAutocomplete
{
    /**
     * @var string
     *
     * @ORM\Column(name="CODEPAYS", type="string", length=2, nullable=false)
     */
    private $codepays;

    /**
     * @var string
     *
     * @ORM\Column(name="CP", type="string", length=10, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="VILLE", type="string", length=180, nullable=false)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set codepays
     *
     * @param string $codepays
     *
     * @return CpAutocomplete
     */
    public function setCodepays($codepays)
    {
        $this->codepays = $codepays;

        return $this;
    }

    /**
     * Get codepays
     *
     * @return string
     */
    public function getCodepays()
    {
        return $this->codepays;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return CpAutocomplete
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return CpAutocomplete
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
