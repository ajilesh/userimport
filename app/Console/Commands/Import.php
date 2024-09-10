<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class Import extends Command
{
    protected $signature = 'import:users {file}';
    protected $description = 'Import users from a CSV file into the database';

    public function handle()
    {
        $file = $this->argument('file');

        try {
            $totalRows = $this->getTotalRows($file);
            $this->output->progressStart($totalRows);

            $import = new UsersImport($this->output);

            // Import the file
            Excel::import($import, $file);

            $this->output->progressFinish();
            $this->info('Users imported successfully!');
        } catch (\Exception $e) {
            $this->output->progressFinish();
            Log::error('Error during import: ' . $e->getMessage());
            $this->error('Failed to import users. Check the log for details.');
        }
    }

    private function getTotalRows($file)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        return $worksheet->getHighestRow();
    }
}
