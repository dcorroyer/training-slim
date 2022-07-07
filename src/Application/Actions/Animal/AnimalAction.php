<?php
declare(strict_types=1);

namespace App\Application\Actions\Animal;

use App\Application\Actions\Action;
use App\Domain\Animal\Animal;
use Psr\Log\LoggerInterface;

abstract class AnimalAction extends Action
{
    /**
     * @var Animal
     */
    protected Animal $animal;

    /**
     * @param LoggerInterface $logger
     * @param Animal  $animal
     */
    public function __construct(LoggerInterface $logger, Animal $animal)
    {
        parent::__construct($logger);
        $this->animal = $animal;
    }
}
