<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property int $status_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'products',
            'order_id',
            'product_id'
        );
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(
            Status::class,
            'orders_status_id_foreign',
            'status_id',
            'status_id'
        );
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function create(array $array)
    {
        $model = new Order([
            'user_id' => $array['user_id']
        ]);
        $model->save();

        $sql = "insert into `order_product`(`order_id`, `product_id`) values (:order_id, :product_id)";
        DB::insert($sql, [
            ':order_id' => $model->order_id,
            ':product_id' => $array['product_id']
        ]);
    }

    public function getOrderProductsByUserId(int $user_id)
    {
        return DB::table('order_product')
            ->join('orders', 'order_product.order_id', '=', 'orders.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.product_id')
            ->join('statuses', 'statuses.status_id', '=','orders.status_id')
            ->select(
                'order_product.order_id as order_id',
                'order_product.product_id as product_id',
                'products.title as title',
                'statuses.title as status',
                'order_product.quantity as quantity',
                'products.price as price'
            )
            ->where('orders.user_id', '=', $user_id)
            ->get()
            ->toArray();
    }

    public function deleteByOrderIdAndProductId(int $order_id, int $product_id)
    {
        $order = DB::table('order_product')
            ->where(['order_id' => $order_id, 'product_id' => $product_id])
            ->delete();
    }

    /**
     * Эта функция считает сумму покупки.
     * @param array $array
     * @return float
     */
    public function resultTotal(array $array)
    {
        $total = 0;
        foreach ($array as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    /**
     * @param array $array
     * @return int
     */
    public function resultQuantity(array $array)
    {
        $quantity = 0;
        foreach ($array as $item) {
            $quantity += $item->quantity;
        }
        return $quantity;
    }
}
