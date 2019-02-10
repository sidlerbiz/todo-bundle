<?php

declare(strict_types=1);

namespace Neo\Bundle\TodoBundle\Entity;

interface TodoEntityInterface
{
    /**
     * Get name
     *
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get Description
     *
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * Set Description
     *
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return bool
     */
    public function getIsDone(): bool;

    /**
     * @param bool $isDone
     */
    public function setIsDone(bool $isDone);

    /**
     * Get Due Date
     *
     * @return \DateTimeInterface
     */
    public function getDueDate(): \DateTimeInterface;

    /**
     * Set Due Date
     *
     * @param \DateTimeInterface $dueDate
     */
    public function setDueDate(\DateTimeInterface $dueDate);
}
