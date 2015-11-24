<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionMeta extends Model {

	protected $table = 'section_metas';

	public function cause() {
		return $this->hasOne('\App\Models\Cause', 'id', 'meta_value_2');
	}

}
