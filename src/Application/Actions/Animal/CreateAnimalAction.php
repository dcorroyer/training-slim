<?php
declare(strict_types=1);

namespace App\Application\Actions\Animal;

use App\Domain\Animal\Animal;
use Psr\Http\Message\ResponseInterface as Response;

class CreateAnimalAction extends AnimalAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $animal = new Animal;
        $animal->name = $data["name"];
        $animal->type = $data["type"];
        $animal->save();
        return $this->respondWithData($animal);
    }
}