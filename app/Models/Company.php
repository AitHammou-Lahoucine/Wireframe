<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
class Company extends Eloquent implements Authenticatable 
{
    use AuthenticatableTrait,HasApiTokens, HasFactory, Notifiable;
    protected $connection ='mongodb';
    use HasFactory;
    protected $fillable =['name','statut'];
}
