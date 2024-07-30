<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{$job->Title}}</h2>

    <p>
        this job pays {{$job->salary}} per year.
    </p>

    <x-button href="/jobs/{{$job->id}}/edit" class="mt-4 ">
        edit job
    </x-button>
</x-layout>
