<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_cts extends Model {

	protected $table = 'sub_cts';

	protected $fillable = [ 'name', 'cat_id', 'created_by', 'status' ];

}
