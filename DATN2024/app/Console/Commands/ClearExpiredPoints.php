<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\UserPoint;
use Illuminate\Console\Command;

class ClearExpiredPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'points:clear-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xoá điểm thưởng hết hạn';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredPoints = UserPoint::where('expire_at', '<', Carbon::now())->get();

        foreach ($expiredPoints as $point) {
            $point->delete(); 
            $this->info("Đã xoá điểm thưởng của người dùng ID: {$point->user_id}");
        }

        $this->info('Xử lý xóa điểm thưởng hết hạn hoàn tất.');
    }
}
