<?php return [

	'menu' => [
		'home'        => 'الصفحة الرئيسية',        // Ballina
		'orphan-list' => 'قائمة الأيتام', // Lista e jetimeve
		'donor-list'  => 'قائمة الكفلاء',  // Lista e donatoreve
		'users'       => 'المستخدمين',       // Perdoruesit
		'contact'     => 'اتصل بنا',     // Kontakto
	],


	'titles' => [
		'orphan-list' => 'قائمة الأيتام', // Lista e jetimeve
		'donor-list'  => 'قائمة الكفلاء',  // Lista e donatoreve
		'user-list'   => 'قائمة المستخدمين'    // Lista e perdoruesve
	],


	'actions' => [
		'add'        => 'أضف',        // Shto
		'add-orphan' => 'أضف يتيم', // Shto Jetim
		'add-donor'  => 'أضف كافل',  // Shto Donator
		'add-user'   => 'أضف مستخدم',   // Shto Perdorues
		'add-report' => 'أضف تقرير', // Shto Raport Financiar
		'delete-report' => 'احذف  التقرير', // Fshij Raportin Financiar

		'change-data'     => 'غير المعلومات',  // Ndrysho te dhenat
		'download-pdf'    => ' حمل على PDF', // Sharko PDF
		'download-report' => 'حمل التقرير المالي', // Sharko Raportin Financiar
		'make-donation'   => 'أتبرع',          // Bej Donacion
		'no-options'      => 'لا توجد خيارات في الوقت الحالي', // Asnje opsion

		'delete' => 'احذف',    // Fshij
		'logout' => 'أخرج',    // Ckycu
		'upload' => 'حمل',    // Ngarko
		'change' => 'غير',    // Ndrysho
		'search' => 'بحث...', // Kerko

		'yes' => 'نعم', // Po
		'no'  => 'لا',  // Jo

		'prev' => 'خلف', // Prapa
		'next' => 'أمام',     // Para

		'send'  => 'أرسل',  // Dergo
		'save'  => 'حفظ',  // Ruaj
		'close' => 'اغلق', // Mbylle
	],


	'fields' => [
		'donor' => [
			'id'       => 'رقم البطاقة',         // ID e Donatorit
			'name'     => 'الاسم',       // Emri i Donatorit
			'email'    => 'العنوان الألكتروني',      // Email e Donatorit
			'password' => 'الرقم السري',   // Fjalekalimi i Donatorit
			'language' => 'اللغة',   // Gjuha e donatorit
			'active'   => 'صالح؟', // A eshte aktiv Donatori
		],

		'user' => [
			'name'     => 'الاسم',       // Emri i Perdoruesit
			'username' => 'اسم المستخدم',   // Emri i Kycjes se Perdoruesit
			'email'    => 'العنوان الألكتروني',      // Email e Perdoruesit
			'password' => 'الرقم السري',   // Fjalekalimi i Perdoruesit
			'language' => 'اللغة',   // Gjuha e perdoruesit
			'role'     => 'الدور',       // Roli i perdoruesit
			'active'   => 'صالح؟', // A eshte aktiv perdoruesi
		],

		'orphan' => [
			'tabs' => [
				'general'   => 'عامة',     // Te Pergjithshme
				'personal'  => 'خاصة',    // Te dhenat personale te jetimit
				'info'      => 'معلومات', // Informata
				'family'    => 'الأسرة',      // Familja,
				'education' => 'التعليم',   // Edukimi
				'residence' => 'مكان الاقامة',   // Vendbanimi
				'documents' => 'اثباتات',   // Dokumentat
				'note'      => 'الاوراق',        // Letra falenderuese
				'reports'   => 'التقارير'      // Raportet
			],

			'general' => [
				'first_name'   => 'الاسم',    // Emri
				'middle_name'  => 'اسم الوالد',   // Emri i prindit
				'last_name'    => 'اللقب',     // Mbiemri
				'gender'       => 'الجنس',        // Gjinia
				'birthday'     => 'تاريخ الميلاد',      // Ditelindja
				'video'        => 'الفيديو',         // Video
				'health_state' => 'الحالة الصحية',  // Gjendja Shendetsore
				'has_donation' => 'توجد كفالة؟', // Ka donacion؟
				'donor_id'     => 'رقم الكافل',      // ID e Donatorit
				'donor'        => 'الكافل',         // Emri i donatorit
				'id'           => 'رقم البطاقة',            // ID e Jetimit
				'phone'        => 'رقم الهاتف',  // Numri i telefonit
				'email'        => 'العنوان الألكتروني',         // Email
				'national_id'  => 'رقم الهوية',   // Numri i leternjoftimit
				'bank_id'      => 'الحساب البنكي',       // Llogaria Bankare
				'documents'    => 'الوثائق',     // Dokumentet
				'note'         => 'الشكر و التقدير',          // Letra falenderuese
			],

			'family' => [
				'members'      => 'الأعضاء',      // Anetaret e familjes
				'brothers'     => 'الاخوة',     // Vellezer
				'sisters'      => 'الاخوات',      // Motra
				'no_parents'   => 'يتيم الأبوين؟',  // Pa dy prinder؟
				'parent_death' => 'وفاة الأب', // Data e vdekjes se prinderit
				'caretaker'    => 'ولي الأمر',    // Kujdestari
				'caretaker_relation' => 'صلة ولي الأمر', // Afersia e kudjestarit
			],

			'education' => [
				'level'    => 'مستوى التعليم',     // Niveli i shkollimit
				'class'    => 'الصف',     // Klasa
				'grades'   => 'التقديرات',    // Notat
				'with_pay' => 'بالمقابل؟', // Me Pagese؟
			],

			'residence' => [
				'country'  => 'الدولة',  // Shteti
				'city'     => 'المدينة',     // Qyteti
				'village'  => 'القرية',  // Fshati
				'property' => 'الملك', // Pronesia
			],

			'finances' => [
				'month'        => 'شهر الكفالة',          // Muaji i donacionit
				'has_donation' => 'توجد كفالة؟',  // Ka donacion؟
				'amount_euro'  => 'القيمة باليورو',  // Shuma ne euro
				'amount_dinar' => 'القيمة بالدينار', // Shuma ne dinar kuwaiti
				'type'         => 'نوع الكفالة',           // Lloji i donacionit
				'received_at'  => 'تاريخ الاستلام',    // Data e marrjes se donacionit
			],
		],
	],


	'languages' => [
		'al'    => 'ألباني',
		'en'    => 'انغليزي',
		'ar-kw' => 'عربي',

		'local' => [
			'albanian' => 'ألباني',
			'english'  => 'انغليزي',
			'arabic'   => 'عربي',
		],
	],


	'time' => [
		'year' => 'السنة',

		'months' => [
			'يناير', 'شباط', 'مارس', 'ابريل', 'مايو', 'حزيران', 
			'تموز', 'أوغست', 'سبتمبر', 'أكتمبر', 'نوفمبر', 'ديسمبر'
		],
	],


	'gender' => [
		'male'   => 'ذكر',
		'female' => 'أنثى',
	],


	'health_state' => [
		'healthy' => 'سليم',
		'sick'    => 'مريض',
	],


	'education' => [
		'pre_school' => 'في الروضة',

		'grades' => [
			1 => 'راسب',
			2 => 'مقبول',
			3 => 'جيد',
			4 => 'جيد جدا',
			5 => 'ممتاز',
		],
	],


	'residence' => [
		'personal' => 'خاصة',
		'with_pay' => 'بالمقابل',
	],


	'roles' => [
		'admin'  => 'مشرف',
		'viewer' => 'محلل',
	],


	'stats' => [
		'all'    => 'جميع',

		'active'   => 'صالح',
		'inactive' => 'ملغي',

		'with-donation'    => 'توجد كفالة',
		'without-donation' => 'لا توجد كفالة',

		'orphans-per-page' => 'اليتيم للصفحة',
		'donors-per-page'  => 'الكافل للصفحة',
		'users-per-page'   => 'المستخدم للصفحة',
	],


	'auth' => [
		'title'          => 'صندوق اعانة المرضى',
		'description'    => 'قاعدة أيتام كوسوفا', // Databaze e jetimeve te Kosoves
		'email-username' => 'العنوان الألكتروني / اسم الدخول',
		'password'       => 'الرقم السري',
		'remember-me'    => 'احفظ',
		'login'          => 'تسجيل الدخول',
	],


	'profile' => [
		'my-profile'       => 'ملفي الشخصي',
		'confirm-password' => 'اعد كلمة السر',
	],


	'email' => [
		'email'   => 'العنوان الألكتروني',
		'subject' => 'الموضوع',
		'message' => 'الرسالة',
	],


	'responses' => [
		'orphan' => [
			'added'   => 'تم تسجيل اليتيم في القاعدة.',
			'updated' => 'تم تحديث بيانات اليتيم.',
			'deleted' => 'تم الحذف بنتيجة.',
			'mass-updated' => 'تم تحديث البيانات.',
			'mass-deleted' => 'تم الحذف بنتيجة.',

			'photo-added'   => 'تم زيادة الصورة.',
			'photo-deleted' => 'تم حذف الصورة.',

			'document-added'   => 'تم زيادة الوثيقة.',
			'document-deleted' => 'تم حذف الوثيقة.',

			'finances-removed' => 'التقرير المالي لعام 2014 تم حذفه من قاعدة البيانات.',
		],

		'donor' => [
			'added'   => 'تم زيادة الكافل.',
			'updated' => 'تم تحديث بيانات الكافل.',
			'deleted' => 'تم الحذف بنتيجة.',
			'mass-deleted' => 'تم الحذف بنتيجة.'
		],

		'user' => [
			'added'   => 'تم زيادة المستخدم.',
			'updated' => 'تم تحديث بيانات المستخدم.',
			'deleted' => 'تم الحذف بنتيجة.',
			'mass-deleted' => 'تم الحذف بنتيجة.',
			'profile-updated' => 'تم تحديث بيانات المستخدم.',
		],

		'email-sent' => 'تم ارسال الرسالة.',
	],


	'errors' => [
		'file-not-image'  => 'الوثيقة غير الموجود في الصورة.',
		'file-not-exists' => 'الوثيقة غير المجودة.',

	],

	'js' => [
		'submission-problems' => 'توجد خطأ في البحث.',

		'success' => 'بنجاح',
		'error'   => 'خطأ',

		'delete-donor'   => 'احذف الكافل',
		'delete-donors'  => 'احذف الكفلاء',
		'delete-orphan'  => 'احذف اليتيم',
		'delete-orphans' => 'احذف الأيتام',
		'delete-user'    => 'احذف المستخدم',
		'delete-users'   => 'احذف المستخدمين',
		'delete-report'  => 'احذف التقرير',

		'donate-email' => [
			'subject' => 'طلب لكفالة اليتيم.',
			'message' => 'أود كفالته ',
		],

		'confirms' => [
			'donor-delete'      => 'هل أنت متأكد أنك تريد حذف هذا الكافل؟',
			'donor-mass-delete' => 'هل أنت متأكد أنك تريد حذف هؤلاء الكفلاء؟',			

			'orphan-delete'      => 'هل أنت متأكد أنك تريد حذف هذا اليتيم؟',
			'orphan-mass-delete' => 'هل أنت متأكد أنك تريد حذف هؤلاء الأيتام؟',			

			'user-delete'      => 'هل أنت متأكد أنك تريد حذف هذا المستخدم؟',
			'user-mass-delete' => 'هل أنت متأكد أنك تريد حذف هؤلاء المستخدمين؟',

			'report-delete'     => 'هل أنت متأكد أنك تريد حذف هذا التقرير؟',


		],
	],


	'extra' => [
		'donors-total'    => 'عدد الكفلاء',
		'donors-active'   => 'الكفلاء المستمرين',
		'donors-inactive' => 'الكفلاء الموقوفين',
		'download-donors-list' => 'احمل قائمة الكفلاء',

		'latest-donors' => 'الكفلاء الأخير تم اضافتهم في القاعدة',
		'latest-users' => 'المستخدين الأخير تم اضافتهم في القاعدة',
		'latest-orphans' => 'الأيتام الأخير تم اضافتهم في القاعدة',

		'orphans-total'            => 'عدد الأيتام',
		'orphans-with-donation'    => 'الأيتام الذين توجد لهم كفالة ',
		'orphans-without-donation' => 'الأيتام الذين لا توجد لهم كفالة',
		'download-orphans-list' => 'تحميل القائمة الأيتام',

		'view-all' => 'انظر الجميع',
	],

	'pdf' => [
		'financial_report' => 'التقرير المالي',
		'month'            => 'الشهر',
		'has_donation'     => 'توجد كفالة؟',
		'amount_euro'      => 'القيمة (اليورو)',
		'amount_dinar'     => 'القيمة (الدينار)',
		'received_at'      => 'تاريخ الاستلام ',
		'type'             => 'نوع الكفالة',

		'euro'  => 'اليورو',
		'dinar' => 'الدينار',

		'months_with_donation'    => 'شهر فيه الكفالة',
		'months_without_donation' => 'شهر لا توجد فيه كفالة',

		'male' => 'ذكر',
		'female' => 'أنثى',

	],
];
