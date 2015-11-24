<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Cause;
use App\Models\SectionMeta;

class HomeController extends BaseController {

	public function getHome() {

		$causes = Cause::where('active', 1)->get();
		$causeofthemonth = SectionMeta::where('meta_key', 'sort')->get();

		return view('page.donate')
			->with('causes', $causes)
			->with('causeofthemonth', $causeofthemonth);

	}

}
