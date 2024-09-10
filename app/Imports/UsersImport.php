<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Illuminate\Console\OutputStyle;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading, WithProgressBar
{
    protected $output;

    public function __construct(OutputStyle $output)
    {
        $this->output = $output;
    }

    public function model(array $row)
    {
        $department = Department::firstOrCreate(['title' => $row['department']]);
        $designation = Designation::firstOrCreate(['title' => $row['designation']]);

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'department_id' => $department->id,
            'designation_id' => $designation->id,
            'password' => bcrypt($row['name'] . '@123'),
            'created_at' => $row['created_at']
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows per chunk
    }

    public function startRow(): int
    {
        return 2; // Assuming the first row is the header
    }

    public function getConsoleOutput(): OutputStyle
    {
        return $this->output;
    }

    public function onProgress(int $count): void
    {
        $this->output->progressAdvance($count);
    }
}
