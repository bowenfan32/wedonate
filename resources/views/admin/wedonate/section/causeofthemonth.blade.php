@extends('layouts.admin')

@section('css')

<link href="{{ asset('assets/libs/jquery-ui-1.11.2.custom/jquery-ui.min.css') }}">

@stop

@section('menu_secondary')

@include('admin.wedonate.menu_secondary')

@stop

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1 class="tw-700">Cause of the Month</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<div class="page-header">
					<h2>Add a cause</h2>
				</div>
				<form id="add-a-cause">
					{!! csrf_field() !!}
					<select name="cause_id">
						@foreach($causes as $cause)
							<option value="{{ $cause->id }}">{{ $cause->name }}</option>
						@endforeach
					</select>
					<button>Add</button>
				</form>

				<div class="page-header">
					<h2>Currently set</h2>
					<h4><i>Press refresh page if any problems occur.</i></h4>
				</div>
				<button class="btn btn-default delete-items" disabled>Delete</button>
				<form class="mt-1 causeofthemonth-form">
					{!! csrf_field() !!}
					<ul id="sortable" style="list-style: none; padding: 0; border-top: 1px solid #eee;">
						@foreach($causeofthemonth as $item)
							<li id="item-{{ $item->id }}" style="border-bottom: 1px solid #eee;">
								<input type="checkbox" name="mark[]" class="mark" value="{{ $item->id }}">
								{{ $item->cause->name }}
							</li>
						@endforeach
					</ul>
				</form>

			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script src="{{ asset('/lib/jquery-ui-1.11.2.custom/jquery-ui.min.js') }}"></script>

<script>

	$(document).ready(function() {

		$('#add-a-cause').on('submit', function(e) {

			e.preventDefault();

			$.ajax({

				url: '/dashboard/sections/cause-of-the-month/add',
				data: $("#add-a-cause").serialize(),
				type: 'POST',
				success: function(data) {

					// Success, now remove the html for each of the deleted elements
					if (data.results) {
						$('#sortable').append('<li id="item-'+ data.results.sort_id +'" style="border-bottom: 1px solid #eee;">' +
							'<input type="checkbox" name="mark[]" class="mark" value="'+ data.results.sort_id +'">' +
							data.results.cause.name +
						'</li>');
					}

				},
				error: function(data) {

					console.log('failure:' + JSON.parse(JSON.stringify(data)));

				}

			});

		});

		// Del

		$('.mark').change(function() {

			var curr_checkbox = $(this);

			if (curr_checkbox.is(':checked')) {
				curr_checkbox.parent().css('border', '1px solid red');
			}
			else {
				curr_checkbox.parent().css('border', 'none');
			}

			if ($('.mark:checked').length > 0) {
				$('.delete-items').removeAttr('disabled');
			}
			else {
				$('.delete-items').attr('disabled', 'disabled');
			}

		});

		$('.delete-items').on('click', function(e) {
			e.preventDefault();

			$.ajax({

				url: '/dashboard/sections/cause-of-the-month/remove',
				data: $(".causeofthemonth-form").serialize(),
				type: 'POST',
				success: function(data) {
					if (data.results) {
						for(var i = 0; i < data.results.length; i++) {
							$('.causeofthemonth-form').find('input[value="' + data.results[i] + '"]').parent().remove();
						}
						// reset the button
						$('.delete-items').attr('disabled', 'disabled');
					}
				},
				error: function(data) {

					console.log('failure:' + JSON.parse(JSON.stringify(data)));

				}

			});
		});

		/*
		----------------------------------------
		| Sortable
		----------------------------------------
		|
		*/
		$('#sortable').sortable({
			axis: 'y',
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				data.append =

				// POST to server using $.post or $.ajax
				$.ajax({
					data: data,
					type: 'POST',
					url: '/dashboard/sections/cause-of-the-month/sort'
				});
			}
		});
	});

</script>

@stop
