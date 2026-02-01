@php
    $dayCourses = ($coursesByDay[$day] ?? collect());
    $slotStart = $toMinutes($slot['start']);
    $slotEnd   = $toMinutes($slot['end']);
    $isRtl = $isRtl ?? false;

    $course = $dayCourses->first(function ($c) use ($slotStart, $slotEnd, $toMinutes) {
        $start = $toMinutes(\Carbon\Carbon::parse($c->date_debut)->format('H:i'));
        $end   = $toMinutes(\Carbon\Carbon::parse($c->date_fin)->format('H:i'));
        return $start < $slotEnd && $end > $slotStart;
    });
@endphp

<td class="border border-gray-200 dark:border-gray-700 p-2 min-h-[60px] vertical-top {{ $isRtl ? 'text-right' : 'text-left' }}">
    @if($course)
        <div class="flex flex-col gap-1">
            <span class="text-xs font-bold text-gray-900 dark:text-white leading-tight">
                {{ $course->matiere->nom_matiere ?? '' }}
            </span>
            <span class="text-[10px] text-primary-600 dark:text-primary-400 font-medium">
                {{ $course->enseignant->nom ?? '' }} {{ $course->enseignant->prenom ?? '' }}
            </span>
        </div>
    @else
        <div class="flex items-center justify-center text-gray-200 dark:text-gray-800 italic">
            —
        </div>
    @endif
</td>
