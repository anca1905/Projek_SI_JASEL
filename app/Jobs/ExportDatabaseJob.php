<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ExportDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $host     = env('DB_HOST');

        $filename = "backup_" . date('Y-m-d_H-i-s') . ".sql";
        $filepath = storage_path('app/' . $filename);

        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';

        $process = Process::fromShellCommandline("\"{$mysqldumpPath}\" -u{$username} -h{$host} {$database} > {$filepath}");

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
