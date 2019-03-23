<?php

namespace App\Console\Commands;

use App\Log\Parser;
use App\Models\ApacheLog;
use App\Models\LogFileQueue;
use Illuminate\Console\Command;

class ParseApacheLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apache_log:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse log file from queue';

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
        $file = LogFileQueue::pop();
        $parser = new Parser($file->file);
        $this->comment('Start parsing file ' . $file->file);
        foreach ($parser->parse() as $line) {
            $log = ApacheLog::create([
                'ip' => $line->getIp(),
                'identity' => $line->getIdentity(),
                'user' => $line->getUser(),
                'date_time' => $line->getDateTime(),
                'timezone' => $line->getTimezone(),
                'method' => $line->getMethod(),
                'status' => $line->getStatus(),
                'path' => $line->getPath(),
                'protocol' => $line->getProtocol(),
                'bytes' => $line->getSize(),
                'referer' => $line->getReferer(),
                'agent' => $line->getAgent(),
            ]);

            $log->save();
        }
        $this->info('Finished');
        $file->setDone();
    }
}
