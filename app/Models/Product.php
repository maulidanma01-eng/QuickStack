<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'code', 'capital_price', 'price',
        'stock', 'min_stock', 'unit', 'description'
    ];

    protected $casts = [
        'capital_price' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOuts(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }

    public function transactionHistories(): HasMany
    {
        return $this->hasMany(TransactionHistory::class);
    }

    /**
     * Get the stock status for display.
     * Returns: 'aman', 'menipis', 'habis'
     */
    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'habis';
        } elseif ($this->stock <= $this->min_stock) {
            return 'menipis';
        }
        return 'aman';
    }

    public function getStockBadgeClassAttribute(): string
    {
        return match($this->stock_status) {
            'habis'   => 'badge-danger',
            'menipis' => 'badge-warning',
            default   => 'badge-success',
        };
    }
}
