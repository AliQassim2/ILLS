<x-layout >
    <!-- start card -->
    <div class="info d-flex justify-content-center mt-5 mx-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="name m-0">{{ $user->name }}</h1>
            <button onClick="toggleEdit()" class="edit-profile btn btn-primary">Edit</button>
        </div>
    </div>
    <!-- end card -->

    <!-- start edit -->
    <form action="profile/{{ $user->id }}"
          method="post"
          class="edit-info "
          style="display: {{ $errors->any() ? 'block' : 'none' }};">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Edit info</h1>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control" type="text" value="{{ old('name', $user->name) }}" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" value="{{ $user->email }}" class="form-control" name="email" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <button type="submit" class="text-center btn fs-4">Save</button>
            <button type="button" onClick="toggleEdit()" class=" btn btn-secondary mt-4">Cancel</button>
        </div>
    </form>
    <!-- end edit -->

    <!-- status -->
    <div class="d-flex justify-content-center mx-4">
        <div class="stats mt-4 mt-lg-0">
            <h1>Status</h1>
            <div class="d-flex flex-column">
                <div class="mx-3 d-flex justify-content-between mt-5 align-items-center">
                    <h3 class="title fs-5">Total Score</h3>
                    <div class="num">{{ $totle_score }}</div>
                </div>
                <div class="mx-3 d-flex justify-content-between mt-5 align-items-center">
                    <h3 class="title fs-5">Reading Story</h3>
                    <div class="num">{{ $stories }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- status -->

    <form class="mt-5 d-flex justify-content-center" action="/logout" method="post">
        @csrf
        <button class="text-black btn log-out" type="submit">Logout</button>
    </form>

    <!-- optional blur styling -->
    <style>
        /* Only blur content when .blur class is on body */
        body.blur .info,
        body.blur .stats,
        body.blur form:not(.edit-info) {
            filter: blur(5px);
        }
    </style>

    <script>
        document.title = "Profile";

        function toggleEdit() {
            const edit = document.querySelector('.edit-info');
            const body = document.body;
            const isVisible = getComputedStyle(edit).display === 'block';

            if (isVisible) {
                edit.style.display = 'none';
                body.classList.remove('blur');
            } else {
                edit.style.display = 'block';
                body.classList.add('blur');
            }
        }

        // If there are validation errors, ensure blur is active
        @if ($errors->any())
            document.body.classList.add('blur');
        @endif
    </script>
</x-layout>
