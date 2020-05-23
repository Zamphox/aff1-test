<?php


namespace App\Models\Mail;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailSchedule extends Model
{
    use SoftDeletes;

    protected $fillable = ['message', 'fire_at'];
}
