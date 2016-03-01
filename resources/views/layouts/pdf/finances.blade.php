@extends('layouts.pdf.base')

@section('content')

<div>
	<h2>{{ trans('general.pdf.financial_report') }} - {{ $year }}</h2><!-- Balkan Data -->

	<h3>بيانات اليتيم</h3><!-- Orphan Info -->
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 10%">رقم اليتيم</th><!-- Orphan ID -->
			<th style="width: 16%">اسم اليتيم</th><!-- Orphan First Name -->
			<th style="width: 16%">اسم العائلة</th><!-- Orphan Last Name -->
			<th style="width: 16%">رقم الكافل</th><!-- Donor ID -->
			<th style="width: 16%">اسم الكافل</th><!-- Donor Name -->
			<th style="width: 10%">دولة</th><!-- Country -->
			<th style="width: 16%">الحالة الصحية</th><!-- Health State -->
		</tr>

		<tr class="border">
			<td>{{ $orphan->id }}</td>
			<td>{{ $orphan->first_name_ar }}</td>
			<td>{{ $orphan->last_name_ar }}</td>

			@if ($orphan->donor_id != null)
				<td>{{ $orphan->donor_id }}</td>
				<td>{{ $orphan->donor->name }}</td>
			@else
				<td>/</td>
				<td>/</td>
			@endif

			<td>{{ $orphan->residence->country }}</td>
			<td>{{ $orphan->health_state == 0 ? trans('general.health_state.sick') : trans('general.health_state.healthy') }}</td>
		</tr>
	</table>

	<h3></h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 20%;">{{ trans('general.pdf.month') }}</th>
			<th style="width: 10%;">{{ trans('general.pdf.has_donation') }}</th>
			<th style="width: 15%;">{{ trans('general.pdf.amount_euro') }}</th>
			<th style="width: 15%;">{{ trans('general.pdf.amount_dinar') }}</th>
			<th style="width: 20%;">{{ trans('general.pdf.received_at') }}</th>
			<th style="width: 20%;">{{ trans('general.pdf.type') }}</th>
		</tr>

		@foreach ($finances as $finance)

		<tr class="border">
			<td>{{ trans("general.time.months.{$finance->month}") }}</td>
			<td>{{ $finance->has_donation == 0 ? trans('general.actions.no') : trans('general.actions.yes') }}</td>
			<td>{{ $finance->amount_euro }}</td>
			<td>{{ $finance->amount_dinar }}</td>
			<td>{{ $finance->received_at }}</td>
			<td>{{ $finance->type }}</td>
		</tr>

		@endforeach
	</table>
	
	<h3></h3>
	
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 75%;">
			{{ trans('general.pdf.months_with_donation') }} - {{ $monthsWithDonation }} 
			({{ $amountReceivedEuro }} {{ trans('general.pdf.euro') }}, {{ $amountReceivedDinar }} {{ trans('general.pdf.dinar') }})
			</th>
		</tr>

		<tr class="border">
			<th style="width: 75%;">
			{{ trans('general.pdf.months_without_donation') }} - {{ $monthsWithoutDonation }}
			({{ $amountNotReceivedEuro }} {{ trans('general.pdf.euro') }}, {{ $amountNotReceivedDinar }} {{ trans('general.pdf.dinar') }})
			</th>
		</tr>
	</table>
</div>

@endsection