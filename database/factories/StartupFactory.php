<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->company,
            'descricao' => $this->faker->realText($maxNbChars = 200),
            'email' => $this->faker->email,
            'cnpj' => $this->faker->cnpj(false),
            'logo' => 'startups/logos/'.$this->faker->image($dir = storage_path('app/test'), $width = 640, $height = 480, null, false),
        ];
    }

    /**
     * Cria uma startup model passando um usuário
     *
     * @return Startup $startup
     */

    public function createStartup(User $user, Area $area)
    {
        $startup = new Startup();
        $startup->nome =  $this->faker->company;
        $startup->descricao = $this->faker->realText($maxNbChars = 200);
        $startup->email = $this->faker->email;
        $startup->cnpj = $this->faker->cnpj(false);
        $startup->logo = 'startups/'.$this->faker->image($dir = storage_path('app/test'), $width = 640, $height = 480, null, false);
        $startup->user_id = $user->id;
        $startup->area_id = $area->id;

        $startup->save();
        return $startup;
    }
}
