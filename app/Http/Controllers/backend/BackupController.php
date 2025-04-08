<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Backup;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

class BackupController extends Controller
{

    public function index()
    {
        $backupFiles = Storage::disk('public')->files('Zahin-Oxus');

        usort($backupFiles, function ($a, $b) {
            return Storage::disk('public')->lastModified($b) - Storage::disk('public')->lastModified($a);
        });

        $backups = array_map(function ($file) {
            return [
                'file' => $file,
                'file_url' => Storage::disk('public')->url($file), // This will generate the correct URL
                'created_at' => date('Y-m-d H:i:s', Storage::disk('public')->lastModified($file)), // Format the timestamp
                'type' => strpos($file, '.zip') !== false ? 'full' : 'database', // Detect type based on file extension
            ];
        }, $backupFiles);

        return Inertia::render("Admin/Backup/Index", [
            'backups' => $backups,
        ]);
    }


    // Store a new backup (via Inertia)
    public function store(Request $request)
    {
        $request->validate([
            'backup_type' => 'required|string|in:full,database,files',
        ]);

        try {
            $backupType = $request->input('backup_type');

            // Correct Artisan call format
            if ($backupType === 'full') {
                // Running the backup:run command for full backup
                $output = Artisan::call('backup:run', ['--env' => env('APP_ENV')]);
            } elseif ($backupType === 'database') {
                // Running the backup:run command for database-only backup
                $output = Artisan::call('backup:run', ['--only-db' => true, '--env' => env('APP_ENV')]);
            } elseif ($backupType === 'files') {
                // Running the backup:run command for files-only backup
                $output = Artisan::call('backup:run', ['--only-files' => true, '--env' => env('APP_ENV')]);
            }

            // Get the command output for debugging or logging
            $result = Artisan::output();
            return dd($result);
            // You can log the output or handle it as needed
            \Log::debug('Backup command output: ' . $result);

            // Returning a response indicating success
            return response()->json([
                'message' => 'Backup started successfully.',
                'output' => $result
            ]);
        } catch (\Exception $e) {
            return dd($e.getMessage());
            // Log the error and return a response with the error message
            \Log::error('Backup failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Backup failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
