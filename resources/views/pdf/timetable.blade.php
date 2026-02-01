<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    @php
        $arabic = new \ArPHP\I18N\Arabic();
        $ar = function($text) use ($arabic) {
            if (!$text || !preg_match('/\p{Arabic}/u', $text)) return $text;
            return $arabic->utf8Glyphs($text);
        };
    @endphp
    <title>{{ $ar(__('app.emploi_temps')) }} - {{ $ar($classe->nom_classe) }}</title>

    <style>
        @page { margin: 18px 18px 45px 18px; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #111827;
            margin: 0;
            padding: 0;
        }

        @if(app()->getLocale() == 'ar')
        body {
            text-align: right;
            direction: rtl;
        }
        @endif

        .header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a56db;
            margin-bottom: 12px;
        }

        .school-name { font-size: 18px; font-weight: bold; color: #1a56db; }
        .title { font-size: 16px; margin-top: 4px; }

        .meta {
            font-size: 12px;
            margin-bottom: 12px;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 8px 6px;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            font-weight: bold;
            text-align: center;
            color: #111827;
        }

        .day-col {
            width: 90px;
            font-weight: bold;
            background: #f8fafc;
            text-align: center;
        }

        .slot-title {
            font-size: 10px;
            color: #334155;
            line-height: 1.2;
        }

        .cell-empty {
            color: #9ca3af;
            text-align: center;
        }

        .course-box {
            padding: 4px;
        }

        html[dir="rtl"] .course-box {
            padding: 4px;
        }

        .course-matiere { font-weight: bold; font-size: 12px; margin-bottom: 2px; }
        .course-teacher { font-size: 10px; color: #475569; }
        .course-time { font-size: 10px; color: #1d4ed8; margin-bottom: 4px; }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 10px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="school-name">{{ $ar(config('app.school_name', config('app.name'))) }}</div>
        <div class="title">{{ $ar(__('app.emploi_temps')) }}</div>
    </div>

    <div class="meta">
        <div><strong>{{ $ar(__('app.classe')) }}:</strong> {{ $ar($classe->nom_classe) }}</div>
        <div><strong>{{ $ar(__('app.date')) }}:</strong> {{ now()->format('d/m/Y') }}</div>
    </div>

    @php
        // ✅ Days
        $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

        // ✅ Time slots: define them ONCE (or pass from controller)
        // Example: each slot is ['start' => '08:00', 'end' => '10:00']
        $timeSlots = $timeSlots ?? [
            ['start' => '08:00', 'end' => '10:00'],
            ['start' => '10:00', 'end' => '12:00'],
            ['start' => '12:00', 'end' => '14:00'],
            ['start' => '14:00', 'end' => '16:00'],
            ['start' => '16:00', 'end' => '18:00'],
        ];

        // ✅ helper to compare times
        $toMinutes = function ($time) {
            [$h, $m] = explode(':', $time);
            return ((int)$h) * 60 + (int)$m;
        };

        // index courses by day for speed
        $coursesByDay = $courses->groupBy('jour');
    @endphp

    <table>
        <thead>
            <tr>
                @if(app()->getLocale() == 'ar')
                    <th style="width: 100px;">{{ $ar(__('app.horaire')) }}</th>
                    @foreach(array_reverse($days) as $day)
                        <th class="day-col">{{ $ar(__("app.$day")) }}</th>
                    @endforeach
                @else
                    <th style="width: 100px;">{{ $ar(__('app.horaire')) }}</th>
                    @foreach($days as $day)
                        <th class="day-col">{{ $ar(__("app.$day")) }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($timeSlots as $slot)
                <tr>
                    @if(app()->getLocale() == 'ar')
                        <td style="text-align: center; background: #f8fafc; font-weight: bold; vertical-align: middle;">
                            <div class="slot-title">
                                {{ $slot['start'] }}<br>-<br>{{ $slot['end'] }}
                            </div>
                        </td>
                        @foreach(array_reverse($days) as $day)
                            @php
                                $dayCourses = ($coursesByDay[$day] ?? collect());
                                $slotStart = $toMinutes($slot['start']);
                                $slotEnd   = $toMinutes($slot['end']);

                                $course = $dayCourses->first(function ($c) use ($slotStart, $slotEnd, $toMinutes) {
                                    $start = $toMinutes(\Carbon\Carbon::parse($c->date_debut)->format('H:i'));
                                    $end   = $toMinutes(\Carbon\Carbon::parse($c->date_fin)->format('H:i'));
                                    return $start < $slotEnd && $end > $slotStart;
                                });  
                            @endphp
                            <td style="height: 50px;">
                                @if($course)
                                    <div class="course-box">
                                        <div class="course-matiere">
                                            {{ $ar($course->matiere->nom_matiere ?? '') }}
                                        </div>
                                        <div class="course-teacher">
                                            {{ $ar(($course->enseignant->nom ?? '') . ' ' . ($course->enseignant->prenom ?? '')) }}
                                        </div>
                                    </div>
                                @else
                                    <div class="cell-empty">—</div>
                                @endif
                            </td>
                        @endforeach
                    @else
                        <td style="text-align: center; background: #f8fafc; font-weight: bold; vertical-align: middle;">
                            <div class="slot-title">
                                {{ $slot['start'] }}<br>-<br>{{ $slot['end'] }}
                            </div>
                        </td>

                        @foreach($days as $day)
                            @php
                                $dayCourses = ($coursesByDay[$day] ?? collect());
                                $slotStart = $toMinutes($slot['start']);
                                $slotEnd   = $toMinutes($slot['end']);

                                $course = $dayCourses->first(function ($c) use ($slotStart, $slotEnd, $toMinutes) {
                                    $start = $toMinutes(\Carbon\Carbon::parse($c->date_debut)->format('H:i'));
                                    $end   = $toMinutes(\Carbon\Carbon::parse($c->date_fin)->format('H:i'));
                                    return $start < $slotEnd && $end > $slotStart;
                                });
                            @endphp

                            <td style="height: 50px;">
                                @if($course)
                                    <div class="course-box">
                                        <div class="course-matiere">
                                            {{ $ar($course->matiere->nom_matiere ?? '') }}
                                        </div>
                                        <div class="course-teacher">
                                            {{ $ar(($course->enseignant->nom ?? '') . ' ' . ($course->enseignant->prenom ?? '')) }}
                                        </div>
                                    </div>
                                @else
                                    <div class="cell-empty">—</div>
                                @endif
                            </td>
                        @endforeach
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        {{ $ar(__('app.generated_by')) }} {{ $ar(config('app.name')) }} — {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
