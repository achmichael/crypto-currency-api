<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Item extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $increment = false;


    protected $fillable = [
        'item_name',
        'quantity',
        'price',
    ];
     // Hashed password value when data save in database
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // use 'creating' event for create UUID
    protected static function boot() {
        parent::boot();
        static::creating(function ($model){
            if (empty($model->{$model->getKeyName()})){
                $model->{$model->getKeyName()} = (string) Str::uuid(); //generate UUID
            }
        });
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'item_name' => $this->item_name,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
