<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Status
 *
 * @property int $status_id
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereTitle($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'status_id';
    protected $fillable = [
        'title'
    ];

    public function orders()
    {
        return $this->hasMany(
            Order::class,
        );
    }
}
