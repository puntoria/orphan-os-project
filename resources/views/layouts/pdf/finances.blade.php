@extends('layouts.pdf.base')

@section('content')

<div>
	<h2>شعبة البلقان</h2>

	<h3>بيانات اليتيم</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 10%">رقم اليتيم</th>
			<th style="width: 16%">اسم اليتيم</th>
			<th style="width: 16%">اسم العائلة</th>
			<th style="width: 16%">رقم الكافل</th>
			<th style="width: 16%">اسم الكافل</th>
			<th style="width: 10%">دولة</th>
			<th style="width: 16%">الحالة الصحية</th>
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
			<td>{{ $orphan->health_state }}</td>
		</tr>
	</table>

	<h3>Raporti Financiar {{ $year }}</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 20%;">Muaji</th>
			<th style="width: 10%;">Dncion?</th>
			<th style="width: 15%;">Shuma Euro</th>
			<th style="width: 15%;">Shuma KW</th>
			<th style="width: 20%;">Data e marrjes</th>
			<th style="width: 20%;">Lloji i donacionit</th>
		</tr>

		@foreach ($finances as $finance)

		<tr class="border">
			<td>{{ $finance->month }}</td>
			<td>{{ $finance->has_donation }}</td>
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
			{{ $monthsWithDonation }} muaj e ka marre donacionin ne vlere prej 
			{{ $amountReceivedEuro }} euro ({{ $amountReceivedDinar }} dinar)
			</th>
		</tr>

		<tr class="border">
			<th style="width: 75%;">
			{{ $monthsWithoutDonation }} muaj nuk e ka marre donacionin ne vlere 
			{{ $amountNotReceivedEuro }} euro ({{ $amountNotReceivedDinar }} dinar)
			</th>
		</tr>
	</table>
</div>

@endsection