@php
    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $timeSlots = [
        ['start' => '08:00', 'end' => '10:00'],
        ['start' => '10:00', 'end' => '12:00'],
        ['start' => '12:00', 'end' => '14:00'],
        ['start' => '14:00', 'end' => '16:00'],
        ['start' => '16:00', 'end' => '18:00'],
    ];


    $toMinutes = function ($time) {
        [$h, $m] = explode(':', $time);
        return ((int)$h) * 60 + (int)$m;
    };

    $coursesByDay = $courses->groupBy('jour');
    $isRtl = app()->getLocale() == 'ar';
@endphp

<div class="p-4 shadow-sm overflow-x-auto" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
    <div class="mb-6 text-center ">
        <h2 class="text-2xl font-bold text-primary-600 dark:text-primary-400 uppercase tracking-wider">
            {{ __('app.emploi_temps') }}
        </h2>
        <p class="text-gray-500 dark:text-gray-400 font-medium">
            {{ $classe->nom_classe }}
        </p>
    </div>

    <table class="w-full border-collapse min-w-[800px]">
        <thead>
            <tr>
                @if($isRtl)
                    <th class="border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 p-3 text-sm font-black text-primary-600 dark:text-primary-400 w-24 text-center">
                        {{ __('app.horaire') }}
                    </th>
                    @foreach(array_reverse($days) as $day)
                        <th class="border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-3 text-sm font-bold text-gray-700 dark:text-gray-200 text-center">
                            {{ __("app.$day") }}
                        </th>
                    @endforeach
                @else
                    <th class="border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 p-3 text-sm font-black text-primary-600 dark:text-primary-400 w-24 text-center">
                        {{ __('app.horaire') }}
                    </th>
                    @foreach($days as $day)
                        <th class="border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-3 text-sm font-bold text-gray-700 dark:text-gray-200 text-center">
                            {{ __("app.$day") }}
                        </th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($timeSlots as $slot)
                <tr>
                    @if($isRtl)
                        <td class="border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-2 text-center align-middle font-bold text-xs text-gray-600 dark:text-gray-400">
                            {{ $slot['start'] }} - {{ $slot['end'] }}
                        </td>
                        @foreach(array_reverse($days) as $day)
                            @include('filament.pages.parts.timetable-cell', ['day' => $day, 'slot' => $slot, 'isRtl' => $isRtl])
                        @endforeach
                    @else
                        <td class="border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-2 text-center align-middle font-bold text-xs text-gray-600 dark:text-gray-400">
                            {{ $slot['start'] }} - {{ $slot['end'] }}
                        </td>
                        @foreach($days as $day)
                            @include('filament.pages.parts.timetable-cell', ['day' => $day, 'slot' => $slot, 'isRtl' => $isRtl])
                        @endforeach
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
