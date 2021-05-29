<?php
// Nemanja Djokic - 496/2013

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;

/**
 * Rune
 *
 * @ORM\Entity()
 * @ORM\Table(name="summoner_rune")
 * @ORM\HasLifecycleCallbacks
 */
class Rune
{

    use ImportedAtTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var RunePage
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\RunePage", inversedBy="runes", cascade={"persist"})
     * @ORM\JoinColumn(name="rune_page_id", referencedColumnName="id")
     */
    protected $runePage;

    /**
     *
     * @var integer
     *  @ORM\Column(name="slot_id", type="integer") 
     */
    protected $slotId;

    /**
     *
     * @var integer
     * @ORM\Column(name="rune_id", type="integer")   
     */
    protected $runeId;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slotId
     *
     * @param integer $slotId
     *
     * @return Rune
     */
    public function setSlotId($slotId)
    {
        $this->slotId = $slotId;

        return $this;
    }

    /**
     * Get slotId
     *
     * @return integer
     */
    public function getSlotId()
    {
        return $this->slotId;
    }

    /**
     * Set runeId
     *
     * @param integer $runeId
     *
     * @return Rune
     */
    public function setRuneId($runeId)
    {
        $this->runeId = $runeId;

        return $this;
    }

    /**
     * Get runeId
     *
     * @return integer
     */
    public function getRuneId()
    {
        return $this->runeId;
    }

    /**
     * Set runePage
     *
     * @param \Psi\AppBundle\Entity\RunePage $runePage
     *
     * @return Rune
     */
    public function setRunePage(\Psi\AppBundle\Entity\RunePage $runePage = null)
    {
        $this->runePage = $runePage;

        return $this;
    }

    /**
     * Get runePage
     *
     * @return \Psi\AppBundle\Entity\RunePage
     */
    public function getRunePage()
    {
        return $this->runePage;
    }
}
