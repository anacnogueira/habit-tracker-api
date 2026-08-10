<x-mail::message>
    # Introduction

    The body of your message.

    <x-mail::table>
        {{ $map }}
    </x-mail::table>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
