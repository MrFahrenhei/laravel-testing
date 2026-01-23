<x-layout>
    <h1>Trabalhos disponíveis</h1>
    <ul>
        @forelse($jobs as $job)
            <li><a href="{{route('jobs.show', $job->id)}}">{{$job->title}} - {{$job->description}}</a></li>
        @empty
            <li>Sem trabaio</li>
        @endforelse
    </ul>
</x-layout>
