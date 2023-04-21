<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceEmployee extends Model
{
    use HasFactory;

    protected $table = "service_employee";

    protected $primaryKey = ["service_id", "employee_id"];

    protected $guarded = ["service_id", "employee_id"];

    public $timestamps = true;
}
