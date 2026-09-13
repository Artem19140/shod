<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'path', 
    'size', 
    'user_id', 
    'is_verified', 
    'original_file_name',
    'type'
])]
class Report extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function types(): array{
        return [
            'weekly' => 'Еженедельный',
            'monthly' => 'Ежемесячный',
            'quarterly' => 'Квартальный',
            'annual' => 'Годовой',
            'adhoc' => 'Внеплановый',
        ];
    }
}
