<?php
namespace Database\Seeders;
use App\Models\Client;
use App\Models\ClientForm;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class ClientFormsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            $client = Client::find($index);
            if ($client && $client->user) {
                ClientForm::create([
                    'client_id' => $client->id,
                    'treatment_wishes' => $faker->text(300),
                    'has_history' => $faker->boolean,
                    'history' => $faker->paragraph,
                    'disease' => $faker->word,
                    'has_disease' => $faker->boolean,
                    'has_allergy' => $faker->boolean,
                    'allergy' => $faker->word,
                    'had_previous_treatments' => $faker->boolean,
                    'previous_treatments' => $faker->paragraph,
                    'medication' => $faker->word,
                    'has_medication' => $faker->boolean,
                    'occupation' => $faker->jobTitle,
                    'video_path' => 'videos/NnGnd7styOnWkuE3qf8SbUqHlijCXPqrzxwrtG8U.mp4',
                    'slug' => Str::slug($client->user->name),
                ]);
            }
        }
    }
}
