<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title'=> $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(2, true),
            'salary'=> $this->faker->numberBetween(4000, 12000),
            'tags'=>implode(', ', $this->faker->words(3)),
            'job_type' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Contract']),
            'remote'=> $this->faker->boolean(),
            'requirements'=> $this->faker->sentence(3),
            'benefits'=> $this->faker->sentence(2),
            'address'=> $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->randomElement([
                'AC','AL','AP','AM','BA','CE','DF','ES','GO','MA',
                'MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN',
                'RS','RO','RR','SC','SP','SE','TO'
            ]),
            'zipcode'=> $this->faker->postcode(),
            'contact_email'=> $this->faker->safeEmail(),
            'contact_phone'=> $this->faker->phoneNumber(),
            'company_name'=> $this->faker->company(),
            'company_description'=> $this->faker->paragraphs(2, true),
            'company_logo'=> $this->faker->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website'=> $this->faker->url(),
        ];
    }
}
