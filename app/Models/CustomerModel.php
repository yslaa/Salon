<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "admins";

    protected $fillable = ["user_id", "deleted_at"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
