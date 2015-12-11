<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Log;
use App\Models\Cause;
use App\Models\SectionMeta;

class PageController extends BaseController {

	public function getPages(Request $request) {

		return view('admin.wedonate.pages');

	}

	public function getSponsors(Request $request) {
		Log::info('getting page.sponsors');
		return view('page.sponsors');

	}

	public function getAbout(Request $request) {
		Log::info('getting page.about');
		return view('page.about');

	}

	public function getFaq(Request $request) {

		return view('page.faq');

	}

	public function getTerms(Request $request) {

		return view('page.terms');

	}

	public function getPrivacy(Request $request) {

		return view('page.privacy');

	}

	public function getDonate(Request $request) {

		$causes = Cause::where('active', 1)->get();
		$causeofthemonth = SectionMeta::where('meta_key', 'sort')->get();

		return view('page.donate')
			->with('causes', $causes)
			->with('causeofthemonth', $causeofthemonth);

	}

	public function getVolunteer(Request $request) {

		return view('page.volunteer');

	}

}
