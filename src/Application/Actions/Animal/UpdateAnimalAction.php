<?php
declare(strict_types=1);

namespace App\Application\Actions\Animal;

use App\Domain\Animal\Animal;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateAnimalAction extends AnimalAction
{
    protected function action(): Response
    {
        $data = $this->parseBody();
        $animalId = (int) $this->resolveArg('id');
        $animal = $this->animal->find($animalId);
        foreach ($data as $key => $value) {
            if (isset($animal->$key)) {
                $animal->$key = $value;
            }
        }
        $animal->save();
        return $this->respondWithData($animal);
    }

    protected function parseBody()
    {
        // parsing from key=value&key2=value2 to [key => value, key2 => value2]
        $data = [];
        $raw = $this->request->getBody()->getContents();
        if (empty($raw)) {
            return $this->request->getParsedBody();
        }
        $cutted = explode("&", $raw);
        foreach ($cutted as $param) {
            list($key, $value) = explode("=", $param);
            $data[$key] = $value;
        }
        return $data;
    }
}
