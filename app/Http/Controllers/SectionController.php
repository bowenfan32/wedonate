<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\SectionMeta;
use App\Models\Cause;

class SectionController extends BaseController {

	public function getSections(Request $request) {

		$sections = Section::all();

		return view('admin.wedonate.section.sections')
			->with('sections', $sections);

	}

	public function getCreateSection(Request $request) {

		return view ('admin.wedonate.section.create');

	}

	public function postCreateSection(Request $request) {

		$section = new Section;
		$section->title = $request->input('title');
		$section->slug = str_slug($request->input('title'), '-');
		$section->save();

		return redirect(route('getSections'))
			->with('messages', 'Section	 created.');

	}

	public function getCauseoftheMonthSection(Request $request) {

		$causes = Cause::where('active', 1)->get();

		$causeofthemonth = SectionMeta::where('section_id', 1)->where('meta_key', 'cause_id')->orderBy('meta_value_2')->get();

		return view('admin.wedonate.section.causeofthemonth')
			->with('causes', $causes)
			->with('causeofthemonth', $causeofthemonth);

	}

	public function postCauseoftheMonthAdd(Request $request) {

		$exists = SectionMeta::where('meta_key', 'cause_id')->where('meta_value', $request->input('cause_id'))->first();
		if ($exists) {
			return [
				'success' => '0',
				'results' => $exists,
				'message' => 'Already exists.'
			];
		}
		$new_causeofmonth = new SectionMeta;
		$new_causeofmonth->section_id = 1;
		$new_causeofmonth->meta_key = 'cause_id';
		$new_causeofmonth->meta_value = $request->input('cause_id');
		$new_causeofmonth->save();

		$sort = new SectionMeta;
		$sort->section_id = 1;
		$sort->meta_key = 'sort';
		$sort->meta_value = $new_causeofmonth->id;
		$sort->meta_value_2 = (SectionMeta::where('meta_key', 'sort')->count()) + 1;
		$sort->save();

		$cause = Cause::where('id', $request->input('cause_id'))->first();

		return [
			'success' => '1',
			'results' => [
				'sort_id' => $sort->meta_value,
				'cause' => $cause
			],
			'messages' => 'Added.'
		];
	}

	public function postCauseoftheMonthSort(Request $request) {

		$order = 1;

		foreach ($_POST['item'] as $value) {
			// Execute statement:
			// UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
			$item = SectionMeta::where('meta_key', 'sort')->where('meta_value', $value)->first();
			$item->meta_value_2 = $order;
			$item->save();

			// Next item's order
			$order++;
		}

	}

	public function postCauseoftheMonthRemove(Request $request) {

		$items = $request->input('mark');

		foreach($items as $item) {
			$item = SectionMeta::where('meta_key', 'sort')->where('meta_value', $item)->first();
			$cause_id = $item->meta_value_2;
			$item = SectionMeta::where('meta_key', 'sort')->where('meta_value_2', $cause_id)->delete();
			$item = SectionMeta::where('meta_key', 'cause_id')->where('meta_value', $cause_id)->delete();
		}

		return [
			'success' => '1',
			'messages' => 'Deleted.',
			'results' => $items
		];

	}

}
