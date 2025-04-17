<x-layout>
    <div class="container mt-5">
        <h1 class="text-center fw-bold mb-4">User Rankings</h1>

        <!-- Rank Selection Buttons -->
        <div class="text-center mb-4">
            @if (request('sort')== 'stories')
            <a href="?sort=score&page=1 " class="btn btn-outline-primary my-2">Rank by Score</a>
            <a href="?sort=stories&page=1" class="btn btn-primary  my-2">Rank by Stories Read</a>
            @else
            <a href="?sort=score&page=1" class="btn btn-primary  my-2">Rank by Score</a>
            <a href="?sort=stories&page=1" class="btn btn-outline-primary  my-2">Rank by Stories Read</a>

            @endif
        </div>

        <!-- Rank List -->
        <div class="card shadow-lg p-2 rounded-4 border-0 bg-light">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>User</th>
                        <th>Score</th>
                        <th>Stories Read</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="text-center">
                        <td>{{ ($index + 1)+ (((request()->page)-1)*20) }}</td>
                        <td class="fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->result->sum('score') }}</td>
                        <td>{{ $user->result->count('stories_id') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(['sort' => request()->sort])->links() }}
    </div>
    <script>
        document.title = "Rank";
    </script>
</x-layout>