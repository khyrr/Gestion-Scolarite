<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/account/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.account.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/account/preferences' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.account.preferences',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/account/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.account.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/account/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.account.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/releve-notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.releve-notes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/academic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings.academic',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/application' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings.application',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/system' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.settings.system',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/two-factor-challenge' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.two-factor-challenge',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/activity-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.activity-logs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/admin-allowed-ips' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.admin-allowed-ips.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/admin-allowed-ips/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.admin-allowed-ips.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/administrateurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.administrateurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/administrateurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.administrateurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/classes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.classes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cours' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.cours.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cours/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.cours.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/enseign-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseign-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/enseign-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseign-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/enseignants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseignants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/enseignants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseignants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etude-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etude-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etude-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etude-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etudiants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etudiants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etudiants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etudiants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/evaluations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.evaluations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/evaluations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.evaluations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/matieres' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.matieres.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/matieres/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.matieres.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.notes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/notes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.notes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.pages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.pages.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.permissions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/permissions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.permissions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/account/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.account.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/account/preferences' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.account.preferences',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/account/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.account.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/account/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.account.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/releve-notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.releve-notes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings/academic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings.academic',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings/application' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings.application',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/settings/system' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.settings.system',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/two-factor-challenge' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.pages.two-factor-challenge',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/activity-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.activity-logs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/admin-allowed-ips' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.admin-allowed-ips.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/admin-allowed-ips/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.admin-allowed-ips.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/administrateurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.administrateurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/administrateurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.administrateurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/classes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.classes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/cours' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.cours.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/cours/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.cours.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/enseign-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseign-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/enseign-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseign-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/enseignants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseignants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/enseignants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseignants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/etude-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etude-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/etude-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etude-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/etudiants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etudiants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/etudiants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etudiants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/evaluations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.evaluations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/evaluations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.evaluations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/matieres' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.matieres.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/matieres/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.matieres.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.notes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/notes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.notes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.pages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/pages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.pages.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.permissions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/permissions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.permissions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/teacher/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/account/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.account.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/account/preferences' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.account.preferences',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/account/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.account.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/account/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.account.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/releve-notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.releve-notes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings/academic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings.academic',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings/application' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings.application',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings.notifications',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings.security',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/settings/system' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.settings.system',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/two-factor-challenge' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.pages.two-factor-challenge',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/activity-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.activity-logs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/admin-allowed-ips' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.admin-allowed-ips.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/admin-allowed-ips/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.admin-allowed-ips.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/administrateurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.administrateurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/administrateurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.administrateurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/classes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.classes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/cours' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.cours.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/cours/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.cours.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/enseign-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseign-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/enseign-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseign-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/enseignants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseignants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/enseignants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseignants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/etude-paiements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etude-paiements.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/etude-paiements/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etude-paiements.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/etudiants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etudiants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/etudiants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etudiants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/evaluations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.evaluations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/evaluations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.evaluations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/matieres' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.matieres.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/matieres/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.matieres.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/notes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.notes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/notes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.notes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.pages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/pages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.pages.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.permissions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/permissions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.permissions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fgKsNEkwW66sS55M',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SHKqrJrOZ5cTkxXl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/profile-information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-profile-information.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user-password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/confirmed-password-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirmation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/two-factor-challenge' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mCnI7nwUglPviVil',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/two-factor-authentication' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.enable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.disable',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/confirmed-two-factor-authentication' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/two-factor-qr-code' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.qr-code',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/two-factor-secret-key' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.secret-key',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/two-factor-recovery-codes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'two-factor.recovery-codes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MvPVjMOYvHL6jnif',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qxsYKfqs5lYyBfxl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.min.js.map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::r1ETIua2qhskWKCt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/upload-file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.upload-file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Khj4Qwu8s2kHpBlL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K4Bxcq6uFj57qOS6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/css/theme.css' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/site-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'site.info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'contact.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'homepage',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FQ6siDFPj7VrZPN8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/filament/(?|exports/([^/]++)/download(*:45)|imports/([^/]++)/failed\\-rows/download(*:90))|/admin/(?|a(?|ctivity\\-logs/([^/]++)(*:134)|dmin(?|\\-allowed\\-ips/([^/]++)/edit(*:177)|istrateurs/([^/]++)(?|/edit(*:212)|(*:220))))|c(?|lasses/([^/]++)/(?|edit(*:258)|timetable(*:275))|ours/([^/]++)/edit(*:302))|e(?|nseign(?|\\-paiements/([^/]++)/edit(*:349)|ants/([^/]++)(?|/edit(*:378)|(*:386)))|tud(?|e\\-paiements/([^/]++)/edit(*:428)|iants/([^/]++)(?|/edit(*:458)|(*:466)))|valuations/([^/]++)(?|/(?|edit(*:506)|grades(*:520))|(*:529)))|matieres/([^/]++)/edit(*:561)|notes/([^/]++)/edit(*:588)|p(?|ages/([^/]++)(?|(*:616)|/edit(*:629))|ermissions/([^/]++)/edit(*:662))|roles/([^/]++)/edit(*:690))|/teacher/(?|a(?|ctivity\\-logs/([^/]++)(*:737)|dmin(?|\\-allowed\\-ips/([^/]++)/edit(*:780)|istrateurs/([^/]++)(?|/edit(*:815)|(*:823))))|c(?|lasses/([^/]++)/(?|edit(*:861)|timetable(*:878))|ours/([^/]++)/edit(*:905))|e(?|nseign(?|\\-paiements/([^/]++)/edit(*:952)|ants/([^/]++)(?|/edit(*:981)|(*:989)))|tud(?|e\\-paiements/([^/]++)/edit(*:1031)|iants/([^/]++)(?|/edit(*:1062)|(*:1071)))|valuations/([^/]++)(?|/(?|edit(*:1112)|grades(*:1127))|(*:1137)))|matieres/([^/]++)/edit(*:1170)|notes/([^/]++)/edit(*:1198)|p(?|ages/([^/]++)(?|(*:1227)|/edit(*:1241))|ermissions/([^/]++)/edit(*:1275))|roles/([^/]++)/edit(*:1304))|/staff/(?|a(?|ctivity\\-logs/([^/]++)(*:1350)|dmin(?|\\-allowed\\-ips/([^/]++)/edit(*:1394)|istrateurs/([^/]++)(?|/edit(*:1430)|(*:1439))))|c(?|lasses/([^/]++)/(?|edit(*:1478)|timetable(*:1496))|ours/([^/]++)/edit(*:1524))|e(?|nseign(?|\\-paiements/([^/]++)/edit(*:1572)|ants/([^/]++)(?|/edit(*:1602)|(*:1611)))|tud(?|e\\-paiements/([^/]++)/edit(*:1654)|iants/([^/]++)(?|/edit(*:1685)|(*:1694)))|valuations/([^/]++)(?|/(?|edit(*:1735)|grades(*:1750))|(*:1760)))|matieres/([^/]++)/edit(*:1793)|notes/([^/]++)/edit(*:1821)|p(?|ages/([^/]++)(?|(*:1850)|/edit(*:1864))|ermissions/([^/]++)/edit(*:1898))|roles/([^/]++)/edit(*:1927))|/l(?|ivewire/preview\\-file/([^/]++)(*:1972)|angue/([^/]++)(*:1995))|/((?!admin|teacher|api|health|langue).*)(*:2045)|/welcome(*:2062)|/livewire/update(*:2087))/?$}sDu',
    ),
    3 => 
    array (
      45 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.exports.download',
          ),
          1 => 
          array (
            0 => 'export',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.imports.failed-rows.download',
          ),
          1 => 
          array (
            0 => 'import',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      134 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.activity-logs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      177 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.admin-allowed-ips.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      212 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.administrateurs.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      220 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.administrateurs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      258 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.classes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.classes.view-timetable',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      302 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.cours.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      349 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseign-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      378 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseignants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      386 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.enseignants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      428 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etude-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      458 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etudiants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      466 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.etudiants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      506 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.evaluations.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      520 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.evaluations.grades',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      529 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.evaluations.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      561 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.matieres.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      588 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.notes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      616 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.pages.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      629 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.pages.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      662 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.permissions.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.resources.roles.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      737 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.activity-logs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      780 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.admin-allowed-ips.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      815 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.administrateurs.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      823 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.administrateurs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      861 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.classes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      878 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.classes.view-timetable',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      905 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.cours.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      952 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseign-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      981 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseignants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      989 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.enseignants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1031 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etude-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1062 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etudiants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.etudiants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1112 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.evaluations.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.evaluations.grades',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1137 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.evaluations.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1170 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.matieres.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1198 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.notes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1227 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.pages.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1241 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.pages.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.permissions.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1304 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.teacher.resources.roles.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1350 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.activity-logs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1394 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.admin-allowed-ips.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1430 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.administrateurs.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1439 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.administrateurs.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1478 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.classes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1496 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.classes.view-timetable',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1524 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.cours.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseign-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1602 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseignants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1611 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.enseignants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1654 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etude-paiements.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1685 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etudiants.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1694 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.etudiants.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1735 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.evaluations.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1750 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.evaluations.grades',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1760 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.evaluations.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1793 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.matieres.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.notes.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1850 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.pages.view',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1864 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.pages.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1898 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.permissions.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1927 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.staff.resources.roles.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1972 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.preview-file',
          ),
          1 => 
          array (
            0 => 'filename',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1995 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lang.switch',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2045 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'page.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2062 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accueil',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2087 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.update',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'filament.exports.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'filament/exports/{export}/download',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'filament.actions',
        ),
        'uses' => 'Filament\\Actions\\Exports\\Http\\Controllers\\DownloadExport@__invoke',
        'controller' => 'Filament\\Actions\\Exports\\Http\\Controllers\\DownloadExport',
        'as' => 'filament.exports.download',
        'namespace' => NULL,
        'prefix' => 'filament',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.imports.failed-rows.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'filament/imports/{import}/failed-rows/download',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'filament.actions',
        ),
        'uses' => 'Filament\\Actions\\Imports\\Http\\Controllers\\DownloadImportFailureCsv@__invoke',
        'controller' => 'Filament\\Actions\\Imports\\Http\\Controllers\\DownloadImportFailureCsv',
        'as' => 'filament.imports.failed-rows.download',
        'namespace' => NULL,
        'prefix' => 'filament',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
        ),
        'uses' => 'App\\Filament\\Pages\\Auth\\Login@__invoke',
        'controller' => 'App\\Filament\\Pages\\Auth\\Login',
        'as' => 'filament.admin.auth.login',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'Filament\\Http\\Controllers\\Auth\\LogoutController@__invoke',
        'controller' => 'Filament\\Http\\Controllers\\Auth\\LogoutController',
        'as' => 'filament.admin.auth.logout',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Dashboard@__invoke',
        'controller' => 'App\\Filament\\Pages\\Dashboard',
        'as' => 'filament.admin.pages.dashboard',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.account.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/account/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Notifications@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Notifications',
        'as' => 'filament.admin.pages.account.notifications',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.account.preferences' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/account/preferences',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Preferences@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Preferences',
        'as' => 'filament.admin.pages.account.preferences',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.account.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/account/profile',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Profile@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Profile',
        'as' => 'filament.admin.pages.account.profile',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.account.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/account/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Security',
        'as' => 'filament.admin.pages.account.security',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.releve-notes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/releve-notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\ReleveNotes@__invoke',
        'controller' => 'App\\Filament\\Pages\\ReleveNotes',
        'as' => 'filament.admin.pages.releve-notes',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings',
        'as' => 'filament.admin.pages.settings',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings.academic' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/academic',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Academic@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Academic',
        'as' => 'filament.admin.pages.settings.academic',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings.application' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/application',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Application@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Application',
        'as' => 'filament.admin.pages.settings.application',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\NotificationSettings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\NotificationSettings',
        'as' => 'filament.admin.pages.settings.notifications',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Security',
        'as' => 'filament.admin.pages.settings.security',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.settings.system' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings/system',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\System@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\System',
        'as' => 'filament.admin.pages.settings.system',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.two-factor-challenge' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/two-factor-challenge',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'uses' => 'App\\Filament\\Pages\\TwoFactorChallenge@__invoke',
        'controller' => 'App\\Filament\\Pages\\TwoFactorChallenge',
        'as' => 'filament.admin.pages.two-factor-challenge',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.activity-logs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/activity-logs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs',
        'as' => 'filament.admin.resources.activity-logs.index',
        'namespace' => NULL,
        'prefix' => 'admin/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.activity-logs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/activity-logs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog',
        'as' => 'filament.admin.resources.activity-logs.view',
        'namespace' => NULL,
        'prefix' => 'admin/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.admin-allowed-ips.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/admin-allowed-ips',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps',
        'as' => 'filament.admin.resources.admin-allowed-ips.index',
        'namespace' => NULL,
        'prefix' => 'admin/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.admin-allowed-ips.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/admin-allowed-ips/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp',
        'as' => 'filament.admin.resources.admin-allowed-ips.create',
        'namespace' => NULL,
        'prefix' => 'admin/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.admin-allowed-ips.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/admin-allowed-ips/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp',
        'as' => 'filament.admin.resources.admin-allowed-ips.edit',
        'namespace' => NULL,
        'prefix' => 'admin/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.administrateurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/administrateurs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs',
        'as' => 'filament.admin.resources.administrateurs.index',
        'namespace' => NULL,
        'prefix' => 'admin/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.administrateurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/administrateurs/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur',
        'as' => 'filament.admin.resources.administrateurs.create',
        'namespace' => NULL,
        'prefix' => 'admin/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.administrateurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/administrateurs/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur',
        'as' => 'filament.admin.resources.administrateurs.edit',
        'namespace' => NULL,
        'prefix' => 'admin/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.administrateurs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/administrateurs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur',
        'as' => 'filament.admin.resources.administrateurs.view',
        'namespace' => NULL,
        'prefix' => 'admin/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses',
        'as' => 'filament.admin.resources.classes.index',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.classes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse',
        'as' => 'filament.admin.resources.classes.create',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.classes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse',
        'as' => 'filament.admin.resources.classes.edit',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.classes.view-timetable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes/{record}/timetable',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable',
        'as' => 'filament.admin.resources.classes.view-timetable',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.cours.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cours',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours',
        'as' => 'filament.admin.resources.cours.index',
        'namespace' => NULL,
        'prefix' => 'admin/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.cours.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cours/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours',
        'as' => 'filament.admin.resources.cours.create',
        'namespace' => NULL,
        'prefix' => 'admin/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.cours.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cours/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours',
        'as' => 'filament.admin.resources.cours.edit',
        'namespace' => NULL,
        'prefix' => 'admin/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseign-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseign-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements',
        'as' => 'filament.admin.resources.enseign-paiements.index',
        'namespace' => NULL,
        'prefix' => 'admin/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseign-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseign-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement',
        'as' => 'filament.admin.resources.enseign-paiements.create',
        'namespace' => NULL,
        'prefix' => 'admin/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseign-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseign-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement',
        'as' => 'filament.admin.resources.enseign-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'admin/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseignants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseignants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants',
        'as' => 'filament.admin.resources.enseignants.index',
        'namespace' => NULL,
        'prefix' => 'admin/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseignants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseignants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant',
        'as' => 'filament.admin.resources.enseignants.create',
        'namespace' => NULL,
        'prefix' => 'admin/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseignants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseignants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant',
        'as' => 'filament.admin.resources.enseignants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.enseignants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/enseignants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant',
        'as' => 'filament.admin.resources.enseignants.view',
        'namespace' => NULL,
        'prefix' => 'admin/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etude-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etude-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements',
        'as' => 'filament.admin.resources.etude-paiements.index',
        'namespace' => NULL,
        'prefix' => 'admin/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etude-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etude-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement',
        'as' => 'filament.admin.resources.etude-paiements.create',
        'namespace' => NULL,
        'prefix' => 'admin/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etude-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etude-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement',
        'as' => 'filament.admin.resources.etude-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'admin/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etudiants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etudiants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants',
        'as' => 'filament.admin.resources.etudiants.index',
        'namespace' => NULL,
        'prefix' => 'admin/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etudiants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etudiants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant',
        'as' => 'filament.admin.resources.etudiants.create',
        'namespace' => NULL,
        'prefix' => 'admin/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etudiants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etudiants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant',
        'as' => 'filament.admin.resources.etudiants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.etudiants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etudiants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant',
        'as' => 'filament.admin.resources.etudiants.view',
        'namespace' => NULL,
        'prefix' => 'admin/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.evaluations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/evaluations',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations',
        'as' => 'filament.admin.resources.evaluations.index',
        'namespace' => NULL,
        'prefix' => 'admin/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.evaluations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/evaluations/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation',
        'as' => 'filament.admin.resources.evaluations.create',
        'namespace' => NULL,
        'prefix' => 'admin/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.evaluations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/evaluations/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation',
        'as' => 'filament.admin.resources.evaluations.edit',
        'namespace' => NULL,
        'prefix' => 'admin/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.evaluations.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/evaluations/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation',
        'as' => 'filament.admin.resources.evaluations.view',
        'namespace' => NULL,
        'prefix' => 'admin/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.evaluations.grades' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/evaluations/{record}/grades',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades',
        'as' => 'filament.admin.resources.evaluations.grades',
        'namespace' => NULL,
        'prefix' => 'admin/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.matieres.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/matieres',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres',
        'as' => 'filament.admin.resources.matieres.index',
        'namespace' => NULL,
        'prefix' => 'admin/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.matieres.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/matieres/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere',
        'as' => 'filament.admin.resources.matieres.create',
        'namespace' => NULL,
        'prefix' => 'admin/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.matieres.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/matieres/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere',
        'as' => 'filament.admin.resources.matieres.edit',
        'namespace' => NULL,
        'prefix' => 'admin/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.notes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes',
        'as' => 'filament.admin.resources.notes.index',
        'namespace' => NULL,
        'prefix' => 'admin/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.notes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote',
        'as' => 'filament.admin.resources.notes.create',
        'namespace' => NULL,
        'prefix' => 'admin/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.notes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote',
        'as' => 'filament.admin.resources.notes.edit',
        'namespace' => NULL,
        'prefix' => 'admin/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.pages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages',
        'as' => 'filament.admin.resources.pages.index',
        'namespace' => NULL,
        'prefix' => 'admin/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.pages.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage',
        'as' => 'filament.admin.resources.pages.create',
        'namespace' => NULL,
        'prefix' => 'admin/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.pages.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage',
        'as' => 'filament.admin.resources.pages.view',
        'namespace' => NULL,
        'prefix' => 'admin/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.pages.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage',
        'as' => 'filament.admin.resources.pages.edit',
        'namespace' => NULL,
        'prefix' => 'admin/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.permissions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions',
        'as' => 'filament.admin.resources.permissions.index',
        'namespace' => NULL,
        'prefix' => 'admin/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.permissions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission',
        'as' => 'filament.admin.resources.permissions.create',
        'namespace' => NULL,
        'prefix' => 'admin/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.permissions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission',
        'as' => 'filament.admin.resources.permissions.edit',
        'namespace' => NULL,
        'prefix' => 'admin/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles',
        'as' => 'filament.admin.resources.roles.index',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole',
        'as' => 'filament.admin.resources.roles.create',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.resources.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'panel:admin',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureAdminRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole',
        'as' => 'filament.admin.resources.roles.edit',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
        ),
        'uses' => 'App\\Filament\\Pages\\Auth\\Login@__invoke',
        'controller' => 'App\\Filament\\Pages\\Auth\\Login',
        'as' => 'filament.teacher.auth.login',
        'namespace' => NULL,
        'prefix' => '/teacher',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'teacher/logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'Filament\\Http\\Controllers\\Auth\\LogoutController@__invoke',
        'controller' => 'Filament\\Http\\Controllers\\Auth\\LogoutController',
        'as' => 'filament.teacher.auth.logout',
        'namespace' => NULL,
        'prefix' => '/teacher',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Dashboard@__invoke',
        'controller' => 'App\\Filament\\Pages\\Dashboard',
        'as' => 'filament.teacher.pages.dashboard',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.account.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/account/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Notifications@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Notifications',
        'as' => 'filament.teacher.pages.account.notifications',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.account.preferences' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/account/preferences',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Preferences@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Preferences',
        'as' => 'filament.teacher.pages.account.preferences',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.account.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/account/profile',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Profile@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Profile',
        'as' => 'filament.teacher.pages.account.profile',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.account.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/account/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Security',
        'as' => 'filament.teacher.pages.account.security',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.releve-notes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/releve-notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\ReleveNotes@__invoke',
        'controller' => 'App\\Filament\\Pages\\ReleveNotes',
        'as' => 'filament.teacher.pages.releve-notes',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings',
        'as' => 'filament.teacher.pages.settings',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings.academic' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings/academic',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Academic@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Academic',
        'as' => 'filament.teacher.pages.settings.academic',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings.application' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings/application',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Application@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Application',
        'as' => 'filament.teacher.pages.settings.application',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\NotificationSettings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\NotificationSettings',
        'as' => 'filament.teacher.pages.settings.notifications',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Security',
        'as' => 'filament.teacher.pages.settings.security',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.settings.system' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/settings/system',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\System@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\System',
        'as' => 'filament.teacher.pages.settings.system',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.pages.two-factor-challenge' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/two-factor-challenge',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'uses' => 'App\\Filament\\Pages\\TwoFactorChallenge@__invoke',
        'controller' => 'App\\Filament\\Pages\\TwoFactorChallenge',
        'as' => 'filament.teacher.pages.two-factor-challenge',
        'namespace' => NULL,
        'prefix' => 'teacher/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.activity-logs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/activity-logs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs',
        'as' => 'filament.teacher.resources.activity-logs.index',
        'namespace' => NULL,
        'prefix' => 'teacher/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.activity-logs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/activity-logs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog',
        'as' => 'filament.teacher.resources.activity-logs.view',
        'namespace' => NULL,
        'prefix' => 'teacher/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.admin-allowed-ips.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/admin-allowed-ips',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps',
        'as' => 'filament.teacher.resources.admin-allowed-ips.index',
        'namespace' => NULL,
        'prefix' => 'teacher/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.admin-allowed-ips.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/admin-allowed-ips/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp',
        'as' => 'filament.teacher.resources.admin-allowed-ips.create',
        'namespace' => NULL,
        'prefix' => 'teacher/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.admin-allowed-ips.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/admin-allowed-ips/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp',
        'as' => 'filament.teacher.resources.admin-allowed-ips.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.administrateurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/administrateurs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs',
        'as' => 'filament.teacher.resources.administrateurs.index',
        'namespace' => NULL,
        'prefix' => 'teacher/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.administrateurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/administrateurs/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur',
        'as' => 'filament.teacher.resources.administrateurs.create',
        'namespace' => NULL,
        'prefix' => 'teacher/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.administrateurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/administrateurs/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur',
        'as' => 'filament.teacher.resources.administrateurs.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.administrateurs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/administrateurs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur',
        'as' => 'filament.teacher.resources.administrateurs.view',
        'namespace' => NULL,
        'prefix' => 'teacher/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/classes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses',
        'as' => 'filament.teacher.resources.classes.index',
        'namespace' => NULL,
        'prefix' => 'teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.classes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/classes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse',
        'as' => 'filament.teacher.resources.classes.create',
        'namespace' => NULL,
        'prefix' => 'teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.classes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/classes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse',
        'as' => 'filament.teacher.resources.classes.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.classes.view-timetable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/classes/{record}/timetable',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable',
        'as' => 'filament.teacher.resources.classes.view-timetable',
        'namespace' => NULL,
        'prefix' => 'teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.cours.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/cours',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours',
        'as' => 'filament.teacher.resources.cours.index',
        'namespace' => NULL,
        'prefix' => 'teacher/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.cours.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/cours/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours',
        'as' => 'filament.teacher.resources.cours.create',
        'namespace' => NULL,
        'prefix' => 'teacher/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.cours.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/cours/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours',
        'as' => 'filament.teacher.resources.cours.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseign-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseign-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements',
        'as' => 'filament.teacher.resources.enseign-paiements.index',
        'namespace' => NULL,
        'prefix' => 'teacher/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseign-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseign-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement',
        'as' => 'filament.teacher.resources.enseign-paiements.create',
        'namespace' => NULL,
        'prefix' => 'teacher/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseign-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseign-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement',
        'as' => 'filament.teacher.resources.enseign-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseignants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseignants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants',
        'as' => 'filament.teacher.resources.enseignants.index',
        'namespace' => NULL,
        'prefix' => 'teacher/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseignants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseignants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant',
        'as' => 'filament.teacher.resources.enseignants.create',
        'namespace' => NULL,
        'prefix' => 'teacher/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseignants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseignants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant',
        'as' => 'filament.teacher.resources.enseignants.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.enseignants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/enseignants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant',
        'as' => 'filament.teacher.resources.enseignants.view',
        'namespace' => NULL,
        'prefix' => 'teacher/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etude-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etude-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements',
        'as' => 'filament.teacher.resources.etude-paiements.index',
        'namespace' => NULL,
        'prefix' => 'teacher/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etude-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etude-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement',
        'as' => 'filament.teacher.resources.etude-paiements.create',
        'namespace' => NULL,
        'prefix' => 'teacher/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etude-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etude-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement',
        'as' => 'filament.teacher.resources.etude-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etudiants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etudiants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants',
        'as' => 'filament.teacher.resources.etudiants.index',
        'namespace' => NULL,
        'prefix' => 'teacher/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etudiants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etudiants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant',
        'as' => 'filament.teacher.resources.etudiants.create',
        'namespace' => NULL,
        'prefix' => 'teacher/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etudiants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etudiants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant',
        'as' => 'filament.teacher.resources.etudiants.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.etudiants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/etudiants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant',
        'as' => 'filament.teacher.resources.etudiants.view',
        'namespace' => NULL,
        'prefix' => 'teacher/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.evaluations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/evaluations',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations',
        'as' => 'filament.teacher.resources.evaluations.index',
        'namespace' => NULL,
        'prefix' => 'teacher/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.evaluations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/evaluations/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation',
        'as' => 'filament.teacher.resources.evaluations.create',
        'namespace' => NULL,
        'prefix' => 'teacher/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.evaluations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/evaluations/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation',
        'as' => 'filament.teacher.resources.evaluations.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.evaluations.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/evaluations/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation',
        'as' => 'filament.teacher.resources.evaluations.view',
        'namespace' => NULL,
        'prefix' => 'teacher/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.evaluations.grades' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/evaluations/{record}/grades',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades',
        'as' => 'filament.teacher.resources.evaluations.grades',
        'namespace' => NULL,
        'prefix' => 'teacher/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.matieres.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/matieres',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres',
        'as' => 'filament.teacher.resources.matieres.index',
        'namespace' => NULL,
        'prefix' => 'teacher/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.matieres.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/matieres/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere',
        'as' => 'filament.teacher.resources.matieres.create',
        'namespace' => NULL,
        'prefix' => 'teacher/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.matieres.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/matieres/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere',
        'as' => 'filament.teacher.resources.matieres.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.notes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes',
        'as' => 'filament.teacher.resources.notes.index',
        'namespace' => NULL,
        'prefix' => 'teacher/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.notes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/notes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote',
        'as' => 'filament.teacher.resources.notes.create',
        'namespace' => NULL,
        'prefix' => 'teacher/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.notes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/notes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote',
        'as' => 'filament.teacher.resources.notes.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.pages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/pages',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages',
        'as' => 'filament.teacher.resources.pages.index',
        'namespace' => NULL,
        'prefix' => 'teacher/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.pages.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/pages/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage',
        'as' => 'filament.teacher.resources.pages.create',
        'namespace' => NULL,
        'prefix' => 'teacher/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.pages.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/pages/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage',
        'as' => 'filament.teacher.resources.pages.view',
        'namespace' => NULL,
        'prefix' => 'teacher/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.pages.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/pages/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage',
        'as' => 'filament.teacher.resources.pages.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.permissions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/permissions',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions',
        'as' => 'filament.teacher.resources.permissions.index',
        'namespace' => NULL,
        'prefix' => 'teacher/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.permissions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/permissions/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission',
        'as' => 'filament.teacher.resources.permissions.create',
        'namespace' => NULL,
        'prefix' => 'teacher/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.permissions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/permissions/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission',
        'as' => 'filament.teacher.resources.permissions.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/roles',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles',
        'as' => 'filament.teacher.resources.roles.index',
        'namespace' => NULL,
        'prefix' => 'teacher/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/roles/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole',
        'as' => 'filament.teacher.resources.roles.create',
        'namespace' => NULL,
        'prefix' => 'teacher/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.teacher.resources.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'teacher/roles/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:teacher',
          1 => 'panel:teacher',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureTeacherRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole',
        'as' => 'filament.teacher.resources.roles.edit',
        'namespace' => NULL,
        'prefix' => 'teacher/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
        ),
        'uses' => 'App\\Filament\\Pages\\Auth\\Login@__invoke',
        'controller' => 'App\\Filament\\Pages\\Auth\\Login',
        'as' => 'filament.staff.auth.login',
        'namespace' => NULL,
        'prefix' => '/staff',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'staff/logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'Filament\\Http\\Controllers\\Auth\\LogoutController@__invoke',
        'controller' => 'Filament\\Http\\Controllers\\Auth\\LogoutController',
        'as' => 'filament.staff.auth.logout',
        'namespace' => NULL,
        'prefix' => '/staff',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Dashboard@__invoke',
        'controller' => 'App\\Filament\\Pages\\Dashboard',
        'as' => 'filament.staff.pages.dashboard',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.account.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/account/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Notifications@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Notifications',
        'as' => 'filament.staff.pages.account.notifications',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.account.preferences' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/account/preferences',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Preferences@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Preferences',
        'as' => 'filament.staff.pages.account.preferences',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.account.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/account/profile',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Profile@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Profile',
        'as' => 'filament.staff.pages.account.profile',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.account.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/account/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Account\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Account\\Security',
        'as' => 'filament.staff.pages.account.security',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.releve-notes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/releve-notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\ReleveNotes@__invoke',
        'controller' => 'App\\Filament\\Pages\\ReleveNotes',
        'as' => 'filament.staff.pages.releve-notes',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings',
        'as' => 'filament.staff.pages.settings',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings.academic' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings/academic',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Academic@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Academic',
        'as' => 'filament.staff.pages.settings.academic',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings.application' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings/application',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Application@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Application',
        'as' => 'filament.staff.pages.settings.application',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings.notifications' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings/notifications',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\NotificationSettings@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\NotificationSettings',
        'as' => 'filament.staff.pages.settings.notifications',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings.security' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings/security',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\Security@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\Security',
        'as' => 'filament.staff.pages.settings.security',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.settings.system' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/settings/system',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\Settings\\System@__invoke',
        'controller' => 'App\\Filament\\Pages\\Settings\\System',
        'as' => 'filament.staff.pages.settings.system',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.pages.two-factor-challenge' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/two-factor-challenge',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'uses' => 'App\\Filament\\Pages\\TwoFactorChallenge@__invoke',
        'controller' => 'App\\Filament\\Pages\\TwoFactorChallenge',
        'as' => 'filament.staff.pages.two-factor-challenge',
        'namespace' => NULL,
        'prefix' => 'staff/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.activity-logs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/activity-logs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ListActivityLogs',
        'as' => 'filament.staff.resources.activity-logs.index',
        'namespace' => NULL,
        'prefix' => 'staff/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.activity-logs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/activity-logs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog@__invoke',
        'controller' => 'App\\Filament\\Resources\\ActivityLogResource\\Pages\\ViewActivityLog',
        'as' => 'filament.staff.resources.activity-logs.view',
        'namespace' => NULL,
        'prefix' => 'staff/activity-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.admin-allowed-ips.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/admin-allowed-ips',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\ListAdminAllowedIps',
        'as' => 'filament.staff.resources.admin-allowed-ips.index',
        'namespace' => NULL,
        'prefix' => 'staff/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.admin-allowed-ips.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/admin-allowed-ips/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\CreateAdminAllowedIp',
        'as' => 'filament.staff.resources.admin-allowed-ips.create',
        'namespace' => NULL,
        'prefix' => 'staff/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.admin-allowed-ips.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/admin-allowed-ips/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdminAllowedIpResource\\Pages\\EditAdminAllowedIp',
        'as' => 'filament.staff.resources.admin-allowed-ips.edit',
        'namespace' => NULL,
        'prefix' => 'staff/admin-allowed-ips',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.administrateurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/administrateurs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ListAdministrateurs',
        'as' => 'filament.staff.resources.administrateurs.index',
        'namespace' => NULL,
        'prefix' => 'staff/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.administrateurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/administrateurs/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\CreateAdministrateur',
        'as' => 'filament.staff.resources.administrateurs.create',
        'namespace' => NULL,
        'prefix' => 'staff/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.administrateurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/administrateurs/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\EditAdministrateur',
        'as' => 'filament.staff.resources.administrateurs.edit',
        'namespace' => NULL,
        'prefix' => 'staff/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.administrateurs.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/administrateurs/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur@__invoke',
        'controller' => 'App\\Filament\\Resources\\AdministrateurResource\\Pages\\ViewAdministrateur',
        'as' => 'filament.staff.resources.administrateurs.view',
        'namespace' => NULL,
        'prefix' => 'staff/administrateurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/classes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ListClasses',
        'as' => 'filament.staff.resources.classes.index',
        'namespace' => NULL,
        'prefix' => 'staff/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.classes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/classes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\CreateClasse',
        'as' => 'filament.staff.resources.classes.create',
        'namespace' => NULL,
        'prefix' => 'staff/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.classes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/classes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\EditClasse',
        'as' => 'filament.staff.resources.classes.edit',
        'namespace' => NULL,
        'prefix' => 'staff/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.classes.view-timetable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/classes/{record}/timetable',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable@__invoke',
        'controller' => 'App\\Filament\\Resources\\ClasseResource\\Pages\\ViewClasseTimetable',
        'as' => 'filament.staff.resources.classes.view-timetable',
        'namespace' => NULL,
        'prefix' => 'staff/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.cours.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/cours',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\ListCours',
        'as' => 'filament.staff.resources.cours.index',
        'namespace' => NULL,
        'prefix' => 'staff/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.cours.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/cours/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\CreateCours',
        'as' => 'filament.staff.resources.cours.create',
        'namespace' => NULL,
        'prefix' => 'staff/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.cours.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/cours/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours@__invoke',
        'controller' => 'App\\Filament\\Resources\\CoursResource\\Pages\\EditCours',
        'as' => 'filament.staff.resources.cours.edit',
        'namespace' => NULL,
        'prefix' => 'staff/cours',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseign-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseign-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\ListEnseignPaiements',
        'as' => 'filament.staff.resources.enseign-paiements.index',
        'namespace' => NULL,
        'prefix' => 'staff/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseign-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseign-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\CreateEnseignPaiement',
        'as' => 'filament.staff.resources.enseign-paiements.create',
        'namespace' => NULL,
        'prefix' => 'staff/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseign-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseign-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignPaiementResource\\Pages\\EditEnseignPaiement',
        'as' => 'filament.staff.resources.enseign-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'staff/enseign-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseignants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseignants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ListEnseignants',
        'as' => 'filament.staff.resources.enseignants.index',
        'namespace' => NULL,
        'prefix' => 'staff/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseignants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseignants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\CreateEnseignant',
        'as' => 'filament.staff.resources.enseignants.create',
        'namespace' => NULL,
        'prefix' => 'staff/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseignants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseignants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\EditEnseignant',
        'as' => 'filament.staff.resources.enseignants.edit',
        'namespace' => NULL,
        'prefix' => 'staff/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.enseignants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/enseignants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EnseignantResource\\Pages\\ViewEnseignant',
        'as' => 'filament.staff.resources.enseignants.view',
        'namespace' => NULL,
        'prefix' => 'staff/enseignants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etude-paiements.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etude-paiements',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\ListEtudePaiements',
        'as' => 'filament.staff.resources.etude-paiements.index',
        'namespace' => NULL,
        'prefix' => 'staff/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etude-paiements.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etude-paiements/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\CreateEtudePaiement',
        'as' => 'filament.staff.resources.etude-paiements.create',
        'namespace' => NULL,
        'prefix' => 'staff/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etude-paiements.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etude-paiements/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudePaiementResource\\Pages\\EditEtudePaiement',
        'as' => 'filament.staff.resources.etude-paiements.edit',
        'namespace' => NULL,
        'prefix' => 'staff/etude-paiements',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etudiants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etudiants',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ListEtudiants',
        'as' => 'filament.staff.resources.etudiants.index',
        'namespace' => NULL,
        'prefix' => 'staff/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etudiants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etudiants/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\CreateEtudiant',
        'as' => 'filament.staff.resources.etudiants.create',
        'namespace' => NULL,
        'prefix' => 'staff/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etudiants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etudiants/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\EditEtudiant',
        'as' => 'filament.staff.resources.etudiants.edit',
        'namespace' => NULL,
        'prefix' => 'staff/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.etudiants.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/etudiants/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant@__invoke',
        'controller' => 'App\\Filament\\Resources\\EtudiantResource\\Pages\\ViewEtudiant',
        'as' => 'filament.staff.resources.etudiants.view',
        'namespace' => NULL,
        'prefix' => 'staff/etudiants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.evaluations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/evaluations',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ListEvaluations',
        'as' => 'filament.staff.resources.evaluations.index',
        'namespace' => NULL,
        'prefix' => 'staff/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.evaluations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/evaluations/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\CreateEvaluation',
        'as' => 'filament.staff.resources.evaluations.create',
        'namespace' => NULL,
        'prefix' => 'staff/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.evaluations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/evaluations/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\EditEvaluation',
        'as' => 'filament.staff.resources.evaluations.edit',
        'namespace' => NULL,
        'prefix' => 'staff/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.evaluations.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/evaluations/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ViewEvaluation',
        'as' => 'filament.staff.resources.evaluations.view',
        'namespace' => NULL,
        'prefix' => 'staff/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.evaluations.grades' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/evaluations/{record}/grades',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades@__invoke',
        'controller' => 'App\\Filament\\Resources\\EvaluationResource\\Pages\\ManageGrades',
        'as' => 'filament.staff.resources.evaluations.grades',
        'namespace' => NULL,
        'prefix' => 'staff/evaluations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.matieres.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/matieres',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\ListMatieres',
        'as' => 'filament.staff.resources.matieres.index',
        'namespace' => NULL,
        'prefix' => 'staff/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.matieres.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/matieres/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\CreateMatiere',
        'as' => 'filament.staff.resources.matieres.create',
        'namespace' => NULL,
        'prefix' => 'staff/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.matieres.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/matieres/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere@__invoke',
        'controller' => 'App\\Filament\\Resources\\MatiereResource\\Pages\\EditMatiere',
        'as' => 'filament.staff.resources.matieres.edit',
        'namespace' => NULL,
        'prefix' => 'staff/matieres',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.notes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/notes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\ListNotes',
        'as' => 'filament.staff.resources.notes.index',
        'namespace' => NULL,
        'prefix' => 'staff/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.notes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/notes/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\CreateNote',
        'as' => 'filament.staff.resources.notes.create',
        'namespace' => NULL,
        'prefix' => 'staff/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.notes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/notes/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote@__invoke',
        'controller' => 'App\\Filament\\Resources\\NoteResource\\Pages\\EditNote',
        'as' => 'filament.staff.resources.notes.edit',
        'namespace' => NULL,
        'prefix' => 'staff/notes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.pages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/pages',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ListPages',
        'as' => 'filament.staff.resources.pages.index',
        'namespace' => NULL,
        'prefix' => 'staff/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.pages.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/pages/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\CreatePage',
        'as' => 'filament.staff.resources.pages.create',
        'namespace' => NULL,
        'prefix' => 'staff/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.pages.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/pages/{record}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\ViewPage',
        'as' => 'filament.staff.resources.pages.view',
        'namespace' => NULL,
        'prefix' => 'staff/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.pages.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/pages/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage@__invoke',
        'controller' => 'App\\Filament\\Resources\\PageResource\\Pages\\EditPage',
        'as' => 'filament.staff.resources.pages.edit',
        'namespace' => NULL,
        'prefix' => 'staff/pages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.permissions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/permissions',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\ListPermissions',
        'as' => 'filament.staff.resources.permissions.index',
        'namespace' => NULL,
        'prefix' => 'staff/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.permissions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/permissions/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\CreatePermission',
        'as' => 'filament.staff.resources.permissions.create',
        'namespace' => NULL,
        'prefix' => 'staff/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.permissions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/permissions/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission@__invoke',
        'controller' => 'App\\Filament\\Resources\\PermissionResource\\Pages\\EditPermission',
        'as' => 'filament.staff.resources.permissions.edit',
        'namespace' => NULL,
        'prefix' => 'staff/permissions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/roles',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\ListRoles',
        'as' => 'filament.staff.resources.roles.index',
        'namespace' => NULL,
        'prefix' => 'staff/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/roles/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\CreateRole',
        'as' => 'filament.staff.resources.roles.create',
        'namespace' => NULL,
        'prefix' => 'staff/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.staff.resources.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff/roles/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:staff',
          1 => 'panel:staff',
          2 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          3 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          4 => 'Illuminate\\Session\\Middleware\\StartSession',
          5 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          6 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          7 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          8 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          9 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          10 => 'BezhanSalleh\\FilamentLanguageSwitch\\Http\\Middleware\\SwitchLanguageLocale',
          11 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          12 => 'Filament\\Http\\Middleware\\Authenticate',
          13 => 'App\\Http\\Middleware\\EnsureStaffRole',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole@__invoke',
        'controller' => 'App\\Filament\\Resources\\RoleResource\\Pages\\EditRole',
        'as' => 'filament.staff.resources.roles.edit',
        'namespace' => NULL,
        'prefix' => 'staff/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fgKsNEkwW66sS55M' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:web',
          2 => 'throttle:login',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\AuthenticatedSessionController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\AuthenticatedSessionController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fgKsNEkwW66sS55M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\AuthenticatedSessionController@destroy',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\AuthenticatedSessionController@destroy',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\PasswordResetLinkController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\PasswordResetLinkController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\NewPasswordController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\NewPasswordController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SHKqrJrOZ5cTkxXl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\RegisteredUserController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\RegisteredUserController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SHKqrJrOZ5cTkxXl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-profile-information.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'user/profile-information',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\ProfileInformationController@update',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\ProfileInformationController@update',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-profile-information.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user-password.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'user/password',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\PasswordController@update',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\PasswordController@update',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'user-password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirmation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/confirmed-password-status',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmedPasswordStatusController@show',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmedPasswordStatusController@show',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirmation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/confirm-password',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmablePasswordController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmablePasswordController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mCnI7nwUglPviVil' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'two-factor-challenge',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:web',
          2 => 'throttle:two-factor',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticatedSessionController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticatedSessionController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mCnI7nwUglPviVil',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/two-factor-authentication',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticationController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticationController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.enable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/confirmed-two-factor-authentication',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmedTwoFactorAuthenticationController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\ConfirmedTwoFactorAuthenticationController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.disable' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'user/two-factor-authentication',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticationController@destroy',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorAuthenticationController@destroy',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.disable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.qr-code' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/two-factor-qr-code',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorQrCodeController@show',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorQrCodeController@show',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.qr-code',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.secret-key' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/two-factor-secret-key',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorSecretKeyController@show',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\TwoFactorSecretKeyController@show',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.secret-key',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'two-factor.recovery-codes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/two-factor-recovery-codes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\RecoveryCodeController@index',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\RecoveryCodeController@index',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'two-factor.recovery-codes',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MvPVjMOYvHL6jnif' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/two-factor-recovery-codes',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:web',
          2 => 'password.confirm',
        ),
        'uses' => 'Laravel\\Fortify\\Http\\Controllers\\RecoveryCodeController@store',
        'controller' => 'Laravel\\Fortify\\Http\\Controllers\\RecoveryCodeController@store',
        'namespace' => 'Laravel\\Fortify\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::MvPVjMOYvHL6jnif',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qxsYKfqs5lYyBfxl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.js',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'as' => 'generated::qxsYKfqs5lYyBfxl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::r1ETIua2qhskWKCt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.min.js.map',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'as' => 'generated::r1ETIua2qhskWKCt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.upload-file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/upload-file',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'as' => 'livewire.upload-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.preview-file' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/preview-file/{filename}',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'as' => 'livewire.preview-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Khj4Qwu8s2kHpBlL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000f0f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Khj4Qwu8s2kHpBlL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K4Bxcq6uFj57qOS6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:807:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000cc10000000000000000";}}',
        'as' => 'generated::K4Bxcq6uFj57qOS6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lang.switch' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'langue/{locale}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:273:"function ($locale) {
    $available = \\array_keys(\\config(\'locales\', [\'fr\' => [], \'ar\' => [], \'en\' => []]));
    if (\\in_array($locale, $available, true)) {
        \\session([\'locale\' => $locale]);
        \\app()->setLocale($locale);
    }
    return \\redirect()->back();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008be0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'lang.switch',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'css/theme.css',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@themeCSS',
        'controller' => 'App\\Http\\Controllers\\PublicController@themeCSS',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'theme.css',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'site.info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/site-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@siteInfo',
        'controller' => 'App\\Http\\Controllers\\PublicController@siteInfo',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'site.info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@search',
        'controller' => 'App\\Http\\Controllers\\PublicController@search',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'contact.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@handleContactForm',
        'controller' => 'App\\Http\\Controllers\\PublicController@handleContactForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'contact.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'homepage' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@homepage',
        'controller' => 'App\\Http\\Controllers\\PublicController@homepage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'homepage',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'page.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PublicController@showPage',
        'controller' => 'App\\Http\\Controllers\\PublicController@showPage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'page.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'slug' => '^(?!admin|teacher|api|health|langue).*$',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accueil' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'welcome',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:294:"function () {
    // If user is authenticated, redirect to appropriate panel
    if (\\auth()->check()) {
        $redirectPath = \\App\\Services\\RoleRedirectService::getRedirectPath(\\auth()->user());
        return \\redirect($redirectPath);
    }
    
    return \\redirect()->route(\'homepage\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000da80000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'accueil',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FQ6siDFPj7VrZPN8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'throttle:60,1',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:799:"function () {
    // Simple health check for production - just returns OK
    if (\\config(\'app.env\') === \'production\') {
        return \\response()->json([
            \'status\' => \'OK\',
            \'timestamp\' => \\now()->toIso8601String(),
        ]);
    }

    // Detailed health check for development/staging
    try {
        $dbStatus = \\DB::connection()->getPdo() ? \'connected\' : \'disconnected\';
    } catch (\\Exception $e) {
        $dbStatus = \'error: \' . $e->getMessage();
    }

    return \\response()->json([
        \'status\' => \'OK\',
        \'timestamp\' => \\now()->toIso8601String(),
        \'app\' => \\config(\'app.name\'),
        \'env\' => \\config(\'app.env\'),
        \'database\' => $dbStatus,
        \'php_version\' => PHP_VERSION,
        \'laravel_version\' => \\app()->version(),
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000c8f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FQ6siDFPj7VrZPN8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/update',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'controller' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'livewire.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
