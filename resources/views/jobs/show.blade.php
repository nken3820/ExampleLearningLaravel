<x-layout>
    <x-slot:heading>
        Job details
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{$job->Title}}</h2>

    <p>
        this job pays {{$job->salary}} per year.
    </p>
    @can('edit-job', $job)
        <x-button href="/jobs/{{$job->id}}/edit" class="mt-4 ">
            edit job
        </x-button>
    @endcan
    
</x-layout>
