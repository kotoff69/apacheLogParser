<?php

namespace App\Console\Commands;

use App\Models\LogFileQueue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddApacheLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apache_log:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add log file to queue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo config('services.log_parser.path') . config('services.log_parser.file_mask') . "\n";
        foreach (glob(config('services.log_parser.path') . config('services.log_parser.file_mask')) as $file) {
            $this->comment('Adding file ' . $file);
            try {
                $queue = LogFileQueue::create([
                    'file' => $file,
                ]);
                $queue->save();
                $this->info('Done ');
            } catch (\Throwable $e) {
                Log::error($e);
                $this->error($e->getMessage());
                continue;
            }
        }
    }
}
