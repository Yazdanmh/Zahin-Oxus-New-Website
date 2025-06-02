<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessDbBackup;
use App\Jobs\ProcessFullBackup;
use App\Models\DatabaseBackup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function listBackups()
    {
        $backups = DatabaseBackup::query()
            ->where('user_id', auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return Inertia::render('Admin/Backup/Index', [
            'backups' => $backups,
        ]);
    }
    public function downloadBackup($filename)
    {
        $filePath = 'backups/' . $filename;

        if (!Storage::exists($filePath)) {
            abort(404, 'Backup file not found.');
        }

        return Storage::download($filePath);
    }
    public function deleteBackup(Request $request)
    {
        try {
            $fileName = $request->input('path');
            $backupDir = storage_path('app/public/backups');
            $backupPath = $backupDir . '/' . $fileName;

            // Verify the file exists and is within the backup directory
            if (file_exists($backupPath) && is_file($backupPath)) {
                // Delete the file
                if (unlink($backupPath)) {
                    // Also delete the database record if needed
                    DatabaseBackup::where('name', $fileName)->delete();

                    \Log::info('Backup file deleted successfully', ['file' => $fileName]);
                    return redirect()->back()->with('message', 'Backup file deleted successfully.');
                }
            }

            \Log::warning('Backup file could not be deleted or not found', ['file' => $fileName]);
            return redirect()->back()->with('message', 'Backup file not found or could not be deleted.');
        } catch (\Exception $e) {
            \Log::error('Failed to delete backup file', [
                'file' => $fileName,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('message', 'Failed to delete backup file: ' . $e->getMessage());
            throw $e;
        }
    }

    public function backup()
    {
        try {
            $userId = Auth::id();
            ProcessDbBackup::dispatch($userId);
            return redirect()->back()->with('message', 'Failed to delete backup file: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Failed: ' . $e->getMessage());
        }
    }



    // Full Laravel application backup
    public function fullBackup()
    {
        $userId = Auth::id();
        ProcessFullBackup::dispatch($userId);
        return redirect()->back()->with('message', 'Files backup has been started. It may take a few minutes to complete.');
    }
}
