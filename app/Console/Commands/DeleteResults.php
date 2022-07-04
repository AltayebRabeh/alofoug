<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Result;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Result::where('end_date', '<=', Carbon::now())->each(function ($result) {
            if(Storage::disk('results')->exists($result->file)) {
                Storage::disk('results')->delete($result->file);
            }
            $result->delete();
        });
    }
}
