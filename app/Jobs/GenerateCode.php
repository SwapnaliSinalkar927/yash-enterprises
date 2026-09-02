<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Code,Brand,WD,LatestCode};
use Str;

class GenerateCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $codesCount, protected int $codesValue, protected int $currentBatch, protected string $brandId)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $brand = Brand::where('id', $this->brandId)->first();
        // $wd = WD::where('id', $this->wdId)->first();

        // Optional safety checks
        if (!$brand) {
            throw new \Exception('Brand or WD not found.');
        }

        // $brandShort = $brand->short_code;

        // $tbWords = explode(' ', trim($wd->tb));
        // $tbShort = strtoupper(implode('', array_map(fn($word) => substr($word, 0, 1), $tbWords)));

        // $wdCode = $wd->code;

        // $prefix = "{$tbShort}{$wdCode}{$brandShort}{$this->codesValue}";

        // Generate unique codes only once
        $generated = [];
        $maxAttempts = $this->codesCount * 2;

        while (count($generated) < $this->codesCount && $maxAttempts--) {
            // $suffix = strtoupper(Str::random(4));
            // $codeStr = $prefix . $suffix;

            $prefix = strtoupper(Str::random(3));

            // 3 number suffix (000–999)
            $suffix = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

            // Final code
            $codeStr = $prefix . $suffix;

            if (!in_array($codeStr, $generated) && !LatestCode::where('code', $codeStr)->exists()) {
                $generated[] = $codeStr;
            }
        }

        // Prepare for bulk insert
        $chunkSize = 500;
        $now = now();
        $value = $this->codesValue;
        // $wdId = $this->wdId;
        $brandId = $this->brandId;
        $currentBatch = $this->currentBatch;

        // Insert codes in chunks
        collect($generated)
            ->chunk($chunkSize)
            ->each(function ($chunk) use ($value, $brandId, $currentBatch, $now) {
                $data = [];

                foreach ($chunk as $codeStr) {
                    $data[] = [
                        'id' => (string) Str::uuid(),
                        'code' => $codeStr,
                        'value' => $value,
                        // 'wd_id' => $wdId,
                        'brand_id' => $brandId,
                        'batch' => $currentBatch,
                        'status' => 1,
                        'is_used' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                LatestCode::insert($data);
            });
    }


}
