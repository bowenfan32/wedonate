<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;

class PageController extends BaseController {

	public function getPages(Request $request) {

		return view('admin.wedonate.pages');

	}

	public function getSponsors(Request $request) {

		return view('page.sponsors');

	}

	public function getAbout(Request $request) {

		return view('page.about');

	}

	public function getPrivacy(Request $request) {

		return view('page.privacy');

	}

	public function getFaq(Request $request) {

		return view('page.faq');

	}

	public function getTerms(Request $request) {

		return view('page.terms');

	}

	public function getDonate(Request $request) {

		return view('page.donate');

	}

	public function getVolunteer(Request $request) {

		return view('page.volunteer');

	}

}
