<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = "admins";

    protected $fillable = ["user_id"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
