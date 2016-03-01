<?php return [

	'menu' => [
		'home'        => 'Ballina',        // Ballina
		'orphan-list' => 'Lista e jetimëve', // Lista e jetimeve
		'donor-list'  => 'Lista e donatorëve',  // Lista e donatoreve
		'users'       => 'Përdoruesit',       // Perdoruesit
		'contact'     => 'Kontakto',     // Kontakto
	],


	'titles' => [
		'orphan-list' => 'Lista e jetimëve', // Lista e jetimeve
		'donor-list'  => 'Lista e donatorëve',  // Lista e donatoreve
		'user-list'   => 'Lista e përdoruesve'    // Lista e perdoruesve
	],


	'actions' => [
		'add'        => 'Shto',        // Shto
		'add-orphan' => 'Shto Jetim', // Shto Jetim
		'add-donor'  => 'Shto Donator',  // Shto Donator
		'add-user'   => 'Shto Përdorues',   // Shto Perdorues
		'add-report' => 'Shto Raport', // Shto Raport Financiar
		'delete-report' => 'Fshij Raportin', // Fshij Raportin Financiar

		'change-data'     => 'Ndrysho të dhënat',  // Ndrysho te dhenat
		'download-pdf'    => 'Shkarko PDF', // Sharko PDF
		'download-report' => 'Shkarko Raportin Financiar', // Sharko Raportin Financiar
		'make-donation'   => 'Bëj Donacion',          // Bej Donacion
		'no-options'      => 'Nuk ka opsione për momentin', // Asnje opsion

		'delete' => 'Fshij',    // Fshij
		'logout' => 'Çkyçu',    // Ckycu
		'upload' => 'Ngarko',    // Ngarko
		'change' => 'Ndrysho',    // Ndrysho
		'search' => 'Kërko...', // Kerko

		'yes' => 'Po', // Po
		'no'  => 'Jo',  // Jo

		'prev' => 'Prapa', // Prapa
		'next' => 'Para',     // Para

		'send'  => 'Dërgo',  // Dergo
		'save'  => 'Ruaj',  // Ruaj
		'close' => 'Mbyll', // Mbylle
	],


	'fields' => [
		'donor' => [
			'id'       => 'ID',         // ID e Donatorit
			'name'     => 'Emri',       // Emri i Donatorit
			'email'    => 'Email',      // Email e Donatorit
			'password' => 'Fjalëkalimi',   // Fjalekalimi i Donatorit
			'language' => 'Gjuha',   // Gjuha e donatorit
			'active'   => 'Aktiv?', // A eshte aktiv Donatori
		],

		'user' => [
			'name'     => 'Emri',       // Emri i Perdoruesit
			'username' => 'Emri i kyçjes',   // Emri i Kycjes se Perdoruesit
			'email'    => 'Email',      // Email e Perdoruesit
			'password' => 'Fjalëkalimi',   // Fjalekalimi i Perdoruesit
			'language' => 'Gjuha',   // Gjuha e perdoruesit
			'role'     => 'Roli',       // Roli i perdoruesit
			'active'   => 'Aktiv?', // A eshte aktiv perdoruesi
		],

		'orphan' => [
			'tabs' => [
				'general'   => 'Të Përgjithshme',     // Te Pergjithshme
				'personal'  => 'Personale',    // Te dhenat personale te jetimit
				'info'      => 'Informata', // Informata
				'family'    => 'Familja',      // Familja,
				'education' => 'Edukimi',   // Edukimi
				'residence' => 'Vendbanimi',   // Vendbanimi
				'documents' => 'Dokumentet',   // Dokumentat
				'note'      => 'Letra',        // Letra falenderuese
				'reports'   => 'Raportet'      // Raportet
			],

			'general' => [
				'first_name'   => 'Emri',    // Emri
				'middle_name'  => 'Emri i prindërit',   // Emri i prindit
				'last_name'    => 'Mbiemri',     // Mbiemri
				'gender'       => 'Gjinia',        // Gjinia
				'birthday'     => 'Ditëlindja',      // Ditelindja
				'video'        => 'Video',         // Video
				'health_state' => 'Gjenda Shëndetësore',  // Gjendja Shendetsore
				'has_donation' => 'Ka Donacion?', // Ka donacion?
				'donor_id'     => 'ID e Donatorit',      // ID e Donatorit
				'donor'        => 'Donatori',         // Emri i donatorit
				'id'           => 'ID',            // ID e Jetimit
				'phone'        => 'Numri i Telefonit',  // Numri i telefonit
				'email'        => 'Email',         // Email
				'national_id'  => 'Numri i Letërnjoftimit',   // Numri i leternjoftimit
				'bank_id'      => 'Llogaria Bankare',       // Llogaria Bankare
				'documents'    => 'Dokumentet',     // Dokumentet
				'note'         => 'Letra Falënderuese',          // Letra falenderuese
			],

			'family' => [
				'members'      => 'Anëtarë',      // Anetaret e familjes
				'brothers'     => 'Vëllezër',     // Vellezer
				'sisters'      => 'Motra',      // Motra
				'no_parents'   => 'Pa dy prindër?',  // Pa dy prinder?
				'parent_death' => 'Vdekja e prindërit', // Data e vdekjes se prinderit
				'caretaker'    => 'Kujdestari',    // Kujdestari
				'caretaker_relation' => 'Afërsia e Kujdestarit', // Afersia e kudjestarit
			],

			'education' => [
				'level'    => 'Niveli i Shkollimit',     // Niveli i shkollimit
				'class'    => 'Klasa',     // Klasa
				'grades'   => 'Notat',    // Notat
				'with_pay' => 'Me Pagesë?', // Me Pagese?
			],

			'residence' => [
				'country'  => 'Shteti',  // Shteti
				'city'     => 'Qyteti',     // Qyteti
				'village'  => 'Fshati',  // Fshati
				'property' => 'Pronësia', // Pronesia
			],

			'finances' => [
				'month'        => 'Muaji i donacionit',          // Muaji i donacionit
				'has_donation' => 'Ka donacion?',  // Ka donacion?
				'amount_euro'  => 'Shuma në euro',  // Shuma ne euro
				'amount_dinar' => 'Shuma në dinar', // Shuma ne dinar kuwaiti
				'type'         => 'Lloji i donacionit',           // Lloji i donacionit
				'received_at'  => 'Data e marrjes',    // Data e marrjes se donacionit
			],
		],
	],


	'languages' => [
		'al'    => 'Shqip',
		'en'    => 'Anglisht',
		'ar-kw' => 'Arabisht (Kuvajt)',

		'local' => [
			'albanian' => 'Shqip',
			'english'  => 'Anglisht',
			'arabic'   => 'Arabisht',
		],
	],


	'time' => [
		'year' => 'Viti',

		'months' => [
			'Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 
			'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nëntor', 'Dhjetor'
		],
	],


	'gender' => [
		'male'   => 'Mashkull',
		'female' => 'Femër',
	],


	'health_state' => [
		'healthy' => 'I Shëndetshëm',
		'sick'    => 'I Sëmurë',
	],


	'education' => [
		'pre_school' => 'Parashkollorë',

		'grades' => [
			1 => 'Pa Mjaftueshëm',
			2 => 'Mjaftueshëm',
			3 => 'Mirë',
			4 => 'Shumë Mirë',
			5 => 'Shkëlqyeshëm',
		],
	],


	'residence' => [
		'personal' => 'Personale',
		'with_pay' => 'Me Pagesë',
	],


	'roles' => [
		'admin'  => 'Admin',
		'viewer' => 'Analist',
	],


	'stats' => [
		'all'    => 'Të Gjithë',

		'active'   => 'Aktiv',
		'inactive' => 'Inaktiv',

		'with-donation'    => 'Me Donacion',
		'without-donation' => 'Pa Donacion',

		'orphans-per-page' => 'jetimë për faqe',
		'donors-per-page'  => 'donatorë për faqe',
		'users-per-page'   => 'përdorues për faqe',
	],


	'auth' => [
		'title'          => 'Patient Help Fund Kosova',
		'description'    => 'Databaza e jetimëve të Kosovës', // Databaze e jetimeve te Kosoves
		'email-username' => 'Email / Emri i kyçjes',
		'password'       => 'Fjalëkalimi',
		'remember-me'    => 'Më mbaj në mend',
		'login'          => 'Kyçu',
	],


	'profile' => [
		'my-profile'       => 'Profili Im',
		'confirm-password' => 'Konfirmo Fjalëkalimin',
	],


	'email' => [
		'email'   => 'Email',
		'subject' => 'Subjekti',
		'message' => 'Mesazhi',
	],


	'responses' => [
		'orphan' => [
			'added'   => 'Jetimi është shtuar në databazë.',
			'updated' => 'Të dhënat e jetimit u përditësuan.',
			'deleted' => 'Fshirja u krye me sukses.',
			'mass-updated' => 'Të dhënat u përditësuan.',
			'mass-deleted' => 'Fshirja u krye me sukses.',

			'photo-added'   => 'Foto është shtuar.',
			'photo-deleted' => 'Foto është fshirë.',

			'document-added'   => 'Dokumenti është shtuar.',
			'document-deleted' => 'Dokumenti është fshirë.',

			'finances-removed' => 'Financat e vitit :year janë fshirë nga databaza.',
		],

		'donor' => [
			'added'   => 'Donatori u shtua.',
			'updated' => 'Të dhënat e donatorit janë përditësuar.',
			'deleted' => 'Fshirja u krye me sukses.',
			'mass-deleted' => 'Fshirja u krye me sukses.'
		],

		'user' => [
			'added'   => 'Përdoruesi u shtua.',
			'updated' => 'Të dhënat e përdoruesit janë përditësuar.',
			'deleted' => 'Fshirja u krye me sukses.',
			'mass-deleted' => 'Fshirja u krye me sukses.',
			'profile-updated' => 'Të dhënat e profilit u përditësuan.',
		],

		'email-sent' => 'Mesazhi juaj është dërguar.',
	],


	'errors' => [
		'file-not-image'  => 'Dokumenti i dhënë nuk është foto.',
		'file-not-exists' => 'Dokumenti nuk ekziston.',

	],

	'js' => [
		'submission-problems' => 'Ka probleme në kërkesën tuaj.',

		'success' => 'Sukses',
		'error'   => 'Gabim',

		'delete-donor'   => 'Fshij Donatorin',
		'delete-donors'  => 'Fshij Donatorët',
		'delete-orphan'  => 'Fshij Jetimin',
		'delete-orphans' => 'Fshij Jetimët',
		'delete-user'    => 'Fshij Përdoruesin',
		'delete-users'   => 'Fshij Përdoruesit',
		'delete-report'  => 'Fshij Raportin',

		'donate-email' => [
			'subject' => 'Kërkesë për të marrë në mbikëqyrje një jetim.',
			'message' => 'Do kisha dëshirë të kujdesem për ',
		],

		'confirms' => [
			'donor-delete'      => 'A jeni i sigurt që dëshironi të fshini këtë donator?',
			'donor-mass-delete' => 'A jeni i sigurt që dëshironi të fshini këta donatorë?',			

			'orphan-delete'      => 'A jeni i sigurt që dëshironi të fshini këtë jetim?',
			'orphan-mass-delete' => 'A jeni i sigurt që dëshironi të fshini këta jetimë?',			

			'user-delete'      => 'A jeni i sigurt që dëshironi të fshini këtë përdorues?',
			'user-mass-delete' => 'A jeni i sigurt që dëshironi të fshini këta përdorues?',

			'report-delete'     => 'A jeni i sigurt që dëshironi të fshini këtë raport?',


		],
	],


	'extra' => [
		'donors-total'    => 'Numri i Donatorëve',
		'donors-active'   => 'Donatorët Aktiv',
		'donors-inactive' => 'Donatorët Inaktiv',
		'download-donors-list' => 'Shkarko Listën e Donatorëve',

		'latest-donors' => 'Donatorët e fundit të shtuar në databazë',
		'latest-users' => 'Përdoruesit e fundit të shtuar në databazë',
		'latest-orphans' => 'Jetimët e fundit të shtuar në databazë',

		'orphans-total'            => 'Numri i Jetimëve',
		'orphans-with-donation'    => 'Jetimët me Donacion',
		'orphans-without-donation' => 'Jetimët pa Donacion',
		'download-orphans-list' => 'Shkarko Listën e Jetimëve',

		'view-all' => 'Shiko të gjithë',
	],

	'pdf' => [
		'financial_report' => 'Raporti Financiar',
		'month'            => 'Muaji',
		'has_donation'     => 'Ka Donacion?',
		'amount_euro'      => 'Shuma (Euro)',
		'amount_dinar'     => 'Shuma (Dinar)',
		'received_at'      => 'Data e marrjes',
		'type'             => 'Lloji i donacionit',

		'euro'  => 'Euro',
		'dinar' => 'Dinar',

		'months_with_donation'    => 'Muaj me donacion',
		'months_without_donation' => 'Muaj pa donacion',

		'male' => 'Mashkull',
		'female' => 'Femër',

	],
];