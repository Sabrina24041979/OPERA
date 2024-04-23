<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin extends User
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PerformanceReview", mappedBy="admin")
     */
    private $performanceReviews;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SystemLog", mappedBy="admin")
     */
    private $systemLogs;

    public function __construct()
    {
        parent::__construct();
        $this->performanceReviews = new ArrayCollection();
        $this->systemLogs = new ArrayCollection();
    }

    /**
     * @return Collection|PerformanceReview[]
     */
    public function getPerformanceReviews(): Collection
    {
        return $this->performanceReviews;
    }

    public function addPerformanceReview(PerformanceReview $performanceReview): self
    {
        if (!$this->performanceReviews->contains($performanceReview)) {
            $this->performanceReviews[] = $performanceReview;
            $performanceReview->setAdmin($this);
        }

        return $this;
    }

    public function removePerformanceReview(PerformanceReview $performanceReview): self
    {
        if ($this->performanceReviews->removeElement($performanceReview)) {
            // set the owning side to null (unless already changed)
            if ($performanceReview->getAdmin() === $this) {
                $performanceReview->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SystemLog[]
     */
    public function getSystemLogs(): Collection
    {
        return $this->systemLogs;
    }

    public function addSystemLog(SystemLog $systemLog): self
    {
        if (!$this->systemLogs->contains($systemLog)) {
            $this->systemLogs[] = $systemLog;
            $systemLog->setAdmin($this);
        }

        return $this;
    }

    public function removeSystemLog(SystemLog $systemLog): self
    {
        if ($this->systemLogs->removeElement($systemLog)) {
            // set the owning side to null (unless already changed)
            if ($systemLog->getAdmin() === $this) {
                $systemLog->setAdmin(null);
            }
        }

        return $this;
    }
}
