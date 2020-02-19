<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['name', 'surname', 'family', 'patronymic', 'image', 'email', 'department_id'];

    protected $table = "department_worker";

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
