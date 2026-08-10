<x-mail::message>
    # Weekly Report

    Here is the weekly report for this week.

    <x-mail::table>
        {{ $map }}
    </x-mail::table>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
