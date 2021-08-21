<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leave';

    protected $fillable = ['start_date', 'end_date', 'employee_id', 'leave_type_id', 'reason'];
}
