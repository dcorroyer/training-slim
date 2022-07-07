<?php

declare(strict_types=1);

namespace App\Application\Actions\Animal;

use Psr\Http\Message\ResponseInterface as Response;

class ListAnimalsAction extends AnimalAction
{
    protected function action(): Response
    {
        $allAnimals = $this->animal->all();
        return $this->respondWithData($allAnimals);
    }
}
