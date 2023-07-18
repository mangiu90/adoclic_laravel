<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Entity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PopulateEntities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-entities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill entities table with https://api.publicapis.org/entries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start: app:populate-entities');

        $categories = Category::all();

        $response = Http::get('https://api.publicapis.org/entries');

        $this->withProgressBar(collect(json_decode($response->body())->entries)
        ->whereIn('Category', $categories->pluck('category')->all()), function ($entry) use ($categories) {
            $category_id = $categories->where('category', $entry->Category)->first()->id;
            Entity::create([
                'api' => $entry->API,
                'description' => $entry->Description,
                'link' => $entry->Link,
                'category_id' => $category_id,
            ]);
        });

        $this->newLine();
        $this->info('End: app:populate-entities');
    }
}
