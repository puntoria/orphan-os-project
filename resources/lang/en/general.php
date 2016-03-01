<?php return [

	'menu' => [
		'home'        => 'Dashboard',   // Ballina
		'orphan-list' => 'Orphan List', // Lista e jetimeve
		'donor-list'  => 'Donor List',  // Lista e donatoreve
		'users'       => 'Users',       // Perdoruesit
		'contact'     => 'Contact',     // Kontakto
	],


	'titles' => [
		'orphan-list' => 'Orphan List', // Lista e jetimeve
		'donor-list'  => 'Donor List',  // Lista e donatoreve
		'user-list'   => 'User List'    // Lista e perdoruesve
	],


	'actions' => [
		'add'        => 'Add',        // Shto
		'add-orphan' => 'Add Orphan', // Shto Jetim
		'add-donor'  => 'Add Donor',  // Shto Donator
		'add-user'   => 'Add User',   // Shto Perdorues
		'add-report' => 'Add Report', // Shto Raport Financiar
		'delete-report' => 'Delete Report', // Fshij Raportin Financiar

		'change-data'     => 'Change Data',  // Ndrysho te dhenat
		'download-pdf'    => 'Download PDF', // Sharko PDF
		'download-report' => 'Download Report', // Sharko Raportin Financiar
		'make-donation'   => 'Donate',          // Bej Donacion
		'no-options'      => 'No Options Available', // Asnje opsion

		'delete' => 'Delete',    // Fshij
		'logout' => 'Logout',    // Ckycu
		'upload' => 'Upload',    // Ngarko
		'change' => 'Change',    // Ndrysho
		'search' => 'Search...', // Kerko

		'yes' => 'Yes', // Po
		'no'  => 'No',  // Jo

		'prev' => 'Previous', // Prapa
		'next' => 'Next',     // Para

		'send'  => 'Send',  // Dergo
		'save'  => 'Save',  // Ruaj
		'close' => 'Close', // Mbylle
	],


	'fields' => [
		'donor' => [
			'id'       => 'ID',         // ID e Donatorit
			'name'     => 'Name',       // Emri i Donatorit
			'email'    => 'Email',      // Email e Donatorit
			'password' => 'Password',   // Fjalekalimi i Donatorit
			'language' => 'Language',   // Gjuha e donatorit
			'active'   => 'Is Active?', // A eshte aktiv Donatori
		],

		'user' => [
			'name'     => 'Name',       // Emri i Perdoruesit
			'username' => 'Username',   // Emri i Kycjes se Perdoruesit
			'email'    => 'Email',      // Email e Perdoruesit
			'password' => 'Password',   // Fjalekalimi i Perdoruesit
			'language' => 'Language',   // Gjuha e perdoruesit
			'role'     => 'Role',       // Roli i perdoruesit
			'active'   => 'Is Active?', // A eshte aktiv perdoruesi
		],

		'orphan' => [
			'tabs' => [
				'general'   => 'General',     // Te Pergjithshme
				'personal'  => 'Personal',    // Te dhenat personale te jetimit
				'info'      => 'Information', // Informata
				'family'    => 'Family',      // Familja,
				'education' => 'Education',   // Edukimi
				'residence' => 'Residence',   // Vendbanimi
				'documents' => 'Documents',   // Dokumentat
				'note'      => 'Note',        // Letra falenderuese
				'reports'   => 'Reports'      // Raportet
			],

			'general' => [
				'first_name'   => 'First Name',    // Emri
				'middle_name'  => 'Middle Name',   // Emri i prindit
				'last_name'    => 'Last Name',     // Mbiemri
				'gender'       => 'Gender',        // Gjinia
				'birthday'     => 'Birthday',      // Ditelindja
				'video'        => 'Video',         // Video
				'health_state' => 'Health State',  // Gjendja Shendetsore
				'has_donation' => 'Has Donation?', // Ka donacion?
				'donor_id'     => 'Donor ID',      // ID e Donatorit
				'donor'        => 'Donor',         // Emri i donatorit
				'id'           => 'ID',            // ID e Jetimit
				'phone'        => 'Phone Number',  // Numri i telefonit
				'email'        => 'Email',         // Email
				'national_id'  => 'National ID',   // Numri i leternjoftimit
				'bank_id'      => 'Bank ID',       // Llogaria Bankare
				'documents'    => 'Documents',     // Dokumentet
				'note'         => 'Note',          // Letra falenderuese
			],

			'family' => [
				'members'      => 'Members',      // Anetaret e familjes
				'brothers'     => 'Brothers',     // Vellezer
				'sisters'      => 'Sisters',      // Motra
				'no_parents'   => 'No Parents?',  // Pa dy prinder?
				'parent_death' => 'Parent Death', // Data e vdekjes se prinderit
				'caretaker'    => 'Caretaker',    // Kujdestari
				'caretaker_relation' => 'Caretaker Relation', // Afersia e kudjestarit
			],

			'education' => [
				'level'    => 'Level',     // Niveli i shkollimit
				'class'    => 'Class',     // Klasa
				'grades'   => 'Grades',    // Notat
				'with_pay' => 'With Pay?', // Me Pagese?
			],

			'residence' => [
				'country'  => 'Country',  // Shteti
				'city'     => 'City',     // Qyteti
				'village'  => 'Village',  // Fshati
				'property' => 'Property', // Pronesia
			],

			'finances' => [
				'month'        => 'Month',          // Muaji i donacionit
				'has_donation' => 'Has Donation?',  // Ka donacion?
				'amount_euro'  => 'Amount (Euro)',  // Shuma ne euro
				'amount_dinar' => 'Amount (Dinar)', // Shuma ne dinar kuwaiti
				'type'         => 'Type',           // Lloji i donacionit
				'received_at'  => 'Received at',    // Data e marrjes se donacionit
			],
		],
	],


	'languages' => [
		'al'    => 'Albanian',
		'en'    => 'English',
		'ar-kw' => 'Arabic (Kuwait)',

		'local' => [
			'albanian' => 'Albanian',
			'english'  => 'English',
			'arabic'   => 'Arabic',
		],
	],


	'time' => [
		'year' => 'Year',

		'months' => [
			'January', 'February', 'March', 'April', 'May', 'June', 
			'July', 'August', 'September', 'October', 'November', 'December'
		],
	],


	'gender' => [
		'male'   => 'Male',
		'female' => 'Female',
	],


	'health_state' => [
		'healthy' => 'Healthy',
		'sick'    => 'Sick',
	],


	'education' => [
		'pre_school' => 'Pre School',

		'grades' => [
			1 => 'Not proficient',
			2 => 'Partially proficient',
			3 => 'Meets Standards',
			4 => 'Advanced',
			5 => 'Exceeds Standards',
		],
	],


	'residence' => [
		'personal' => 'Personal',
		'with_pay' => 'With Pay',
	],


	'roles' => [
		'admin'  => 'Admin',
		'viewer' => 'Viewer',
	],


	'stats' => [
		'all'    => 'All',

		'active'   => 'Active',
		'inactive' => 'Inactive',

		'with-donation'    => 'With Donation',
		'without-donation' => 'Without Donation',

		'orphans-per-page' => 'orphans per page',
		'donors-per-page'  => 'donors per page',
		'users-per-page'   => 'users per page',
	],


	'auth' => [
		'title'          => 'Patient Help Fund Kosova',
		'description'    => 'Kosovo\'s Orphan Database', // Databaze e jetimeve te Kosoves
		'email-username' => 'Email / Username',
		'password'       => 'Password',
		'remember-me'    => 'Remember Me',
		'login'          => 'Login',
	],


	'profile' => [
		'my-profile'       => 'My Profile',
		'confirm-password' => 'Confirm Password',
	],


	'email' => [
		'email'   => 'Email',
		'subject' => 'Subject',
		'message' => 'Message',
	],


	'responses' => [
		'orphan' => [
			'added'   => 'Orphan has been successfully added.',
			'updated' => 'Orphan has been updated.',
			'deleted' => 'Orphan has been deleted.',
			'mass-updated' => 'Orphans have been updated.',
			'mass-deleted' => 'Orphans have been deleted.',

			'photo-added'   => 'Photo has been added.',
			'photo-deleted' => 'Photo has been deleted.',

			'document-added'   => 'Document has been added.',
			'document-deleted' => 'Document has been deleted.',

			'finances-removed' => 'Finances from :year have been removed from database',
		],

		'donor' => [
			'added'   => 'Donor has been successfully added.',
			'updated' => 'Donor has been updated.',
			'deleted' => 'Donor has been deleted.',
			'mass-deleted' => 'Donors have been deleted.'
		],

		'user' => [
			'added'   => 'User has been successfully added.',
			'updated' => 'User has been updated.',
			'deleted' => 'User has been deleted.',
			'mass-deleted' => 'Users have been deleted.',
			'profile-updated' => 'Your profile data has been updated.',
		],

		'email-sent' => 'Your message was successfully sent.',
	],


	'errors' => [
		'file-not-image'  => 'The given file is not an image.',
		'file-not-exists' => 'File does not exist.',

	],


	'js' => [
		'submission-problems' => 'There were problems with your submission.',

		'success' => 'Success',
		'error'   => 'Error',

		'delete-donor'   => 'Delete Donor',
		'delete-donors'  => 'Delete Donors',
		'delete-orphan'  => 'Delete Orphan',
		'delete-orphans' => 'Delete Orphans',
		'delete-user'    => 'Delete User',
		'delete-users'   => 'Delete Users',
		'delete-report'  => 'Delete Report',

		'donate-email' => [
			'subject' => 'Request to take care of an orphan',
			'message' => 'I would like to take care of ',
		],

		'confirms' => [
			'donor-delete'      => 'Are you sure you want to delete this donor?',
			'donor-mass-delete' => 'Are you sure you want to delete these donors?',			

			'orphan-delete'      => 'Are you sure you want to delete this orphan?',
			'orphan-mass-delete' => 'Are you sure you want to delete these orphans?',			

			'user-delete'      => 'Are you sure you want to delete this user?',
			'user-mass-delete' => 'Are you sure you want to delete these users?',

			'report-delete'     => 'Are you sure you want to delete this report?',


		],
	],


	'extra' => [
		'donors-total'    => 'Number of Donors',
		'donors-active'   => 'Active Donors',
		'donors-inactive' => 'Inactive Donors',
		'download-donors-list' => 'Download Donors List',

		'latest-donors' => 'Latest Donors added to database',
		'latest-users' => 'Latest Users added to database',
		'latest-orphans' => 'Latest Orphans added to database',

		'orphans-total'            => 'Number of Orphans',
		'orphans-with-donation'    => 'Orphans with donation',
		'orphans-without-donation' => 'Orphans without donation',
		'download-orphans-list' => 'Download Orphans List',

		'view-all' => 'View All',
	],

];