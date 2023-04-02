<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = "suppliers";

    protected $fillable = ["user_id"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
