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

	<h3>Raporti Financiar 2015</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 20%;">Muaji</th>
			<th style="width: 10%;">Dncion?</th>
			<th style="width: 15%;">Shuma Euro</th>
			<th style="width: 15%;">Shuma KW</th>
			<th style="width: 20%;">Data e marrjes</th>
			<th style="width: 20%;">Lloji i donacionit</th>
		</tr>

		<tr class="border">
			<td>Janar</td>
			<td>Po</td>
			<td>25 E</td>
			<td>140 D</td>
			<td>25-01-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Mars</td>
			<td>Jo</td>
			<td>/</td>
			<td>/</td>
			<td>/</td>
			<td>/</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

				<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>

		<tr class="border">
			<td>Shkurt</td>
			<td>Po</td>
			<td>40 E</td>
			<td>260 D</td>
			<td>16-02-2015</td>
			<td>Donacion</td>
		</tr>
	</table>
	
	<h3></h3>
	
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 75%;">11 Muaj e ka marre donacionin ne vlere prej 550 Euro (1440 KW)</th>
		</tr>

		<tr class="border">
			<th style="width: 75%;">1 Muaj nuk e ka marre donacionin ne vlere 40 Euro (160 KW)</th>
		</tr>
	</table>

</div>

@endsection