@extends('layouts.pdf.base')

@section('content')

<div>
	<h2>شعبة البلقان</h2>

	<h3>بيانات اليتيم</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 10%">رقم اليتيم</th>
			<th style="width: 16%">اسم اليتيم</th>
			<th style="width: 16%">اسم الأب</th>
			<th style="width: 16%">اسم العائلة</th>
			<th style="width: 10%">الجنس</th>
			<th style="width: 16%">تاريخ الميلاد</th>
			<th style="width: 16%">الحالة الصحية</th>
		</tr>

		<tr class="border">
			<td>{{ $orphan->id }}</td>
			<td>{{ $orphan->first_name_ar }}</td>
			<td>{{ $orphan->middle_name_ar }}</td>
			<td>{{ $orphan->last_name_ar }}</td>
			<td>{{ $orphan->gender == 0 ? trans('general.gender.male') : trans('general.gender.female') }}</td>
			<td>{{ $orphan->birthday }}</td>
			<td>{{ $orphan->health_state == 0 ? trans('general.health_state.sick') : trans('general.health_state.healthy') }}</td>
		</tr>
	</table>


	<h3>بيانات عائلة اليتيم</h3>
	<table cellpadding="5" cellspacing="0">
			<tr class="border">
				<th style="width: 12%">تاريخ الوفاة الأب</th>
				<th style="width: 20%">ولي أمر اليتيم</th>
				<th style="width: 20%">صلة القرابة</th>
				<th style="width: 9%">يتيم الأبوين</th>
				<th style="width: 9%">عدد أفراد الأسرة</th>
				<th style="width: 9%">عدد الأخوة</th>
				<th style="width: 9%">عدد الأخوات</th>
				<th style="width: 12%">الإمتلاكات</th>
			</tr>

			<tr class="border">
				<td>{{ $orphan->family->parent_death }}</td>
				<td>{{ $orphan->family->caretaker_name }}</td>
				<td>{{ $orphan->family->caretaker_relation }}</td>
				<td>{{ $orphan->family->no_parents == 0 ? trans('general.actions.no') : trans('general.actions.yes') }}</td>
				<td>{{ $orphan->family->family_members }}</td>
				<td>{{ $orphan->family->brothers }}</td>
				<td>{{ $orphan->family->sisters }}</td>
				<td>{{ $orphan->residence->ownership == 0 ? trans('general.residence.with_pay') : trans('general.residence.personal') }}</td>
			</tr>
	</table>


	<h3>بيانات التعليمية</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width:25%;">المستوى</th>
			<th style="width:25%;">الصف</th>
			<th style="width:25%;">النجاح</th>
			<th style="width:25%;">نوعية التعليم</th>
		</tr>

		<tr class="border">
			<td>{{ $orphan->education->level }}</td>
			<td>{{ $orphan->education->class == 0 ? trans('general.education.pre_school') : $orphan->education->class }}</td>
			<td>{{ trans("general.education.grades.{$orphan->education->grades}") }}</td>
			<td>{{ $orphan->education->with_pay == 0 ? trans('general.actions.no') : trans('general.actions.yes') }}</td>
		</tr>
	</table>


	<h3>السكن</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 17%;">دولة</th>
			<th style="width: 17%;">مدينة</th>
			<th style="width: 17%;">قرية</th>
			<th style="width: 19%;">الهاتف</th>
			<th style="width: 30%;">بريد الألكتروني</th>
		</tr>

		<tr class="border">
			<td>{{ $orphan->residence->country }}</td>
			<td>{{ $orphan->residence->city }}</td>
			<td>{{ $orphan->residence->village }}</td>
			<td>{{ $orphan->phone }}</td>
			<td>{{ $orphan->email }}</td>
		</tr>
	</table>

	<h3>بيانات الكافل</h3>
	<table cellpadding="5" cellspacing="0">
		<tr class="border">
			<th style="width: 50%;">رقم الكافل</th>
			<th style="width: 50%;">اسم الكافل</th>
		</tr>

		<tr class="border">
			@if ($orphan->donor_id != null)
				<td>{{ $orphan->donor_id }}</td>
				<td>{{ $orphan->donor->name }}</td>
			@else
				<td>/</td>
				<td>/</td>
			@endif
		</tr>
	</table>

	<h3></h3>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td style="width: 2%;
			background-color: #fffaea; 
			border-top: 1px solid #d5c3b4; 
			border-bottom: 1px solid #d5c3b4; 
			border-right: 1px solid #d5c3b4;"></td>

			<td style="
			width: 60%; 
			background-color: #fffaea; 
			border-top: 1px solid #d5c3b4; 
			border-bottom: 1px solid #d5c3b4; 
			text-align: center" valign="middle">
				<h5 style="font-size: 1px;"></h5>
				<h3 style="text-align: center; color: rgb(194,146,0);">رسالة الشكر</h3>
				{{ $orphan->note }}
				<br><br>
				<h3 style="text-align: center; font-size: 12px;">(الفديو لليتيم)</h3>
				<a target="_blank" style="font-size: 11px;" href="{{ $orphan->video }}">{{ $orphan->video }}</a>
			</td>

			<td style="width: 2%;
			background-color: #fffaea; 
			border-top: 1px solid #d5c3b4; 
			border-bottom: 1px solid #d5c3b4; 
			border-left: 1px solid #d5c3b4;"></td>

			<td style="width: 4%; background-color: #f9eed0;"></td>
			<td style="width: 32%; background-color: #f9eed0;">
				<img src="{{ storage_path("app/photos/{$orphan->getPhoto()}") }}" width="300" height="400">
			</td>
		</tr>
	</table>
</div>

@endsection