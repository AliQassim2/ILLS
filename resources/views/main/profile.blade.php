<x-layout>
    <!-- start card -->
    <div class="info d-flex justify-content-center mt-5 mx-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="name m-0">{{$user->name}}</h1>
            <button onClick="edit()" class="edit-profile btn btn-primery">Edit</button>
        </div>
    </div>
    <!-- end card -->
    <!-- start edit -->
    <form action="profile/{{$user->id}}" method="post" class="d-flex justify-content-center align-items-center flex-column flex-lg-row my-5 mx-0 mx-lg-5">
        <div class="edit-info p5 mx-5 ">
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
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input class="form-control" type="text" value="{{ $user->name }}" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required disabled>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input class="form-control" type="password" name='password'>
            </div>
            <button type="submit " class="btn fs-4 mt-4">Save</button>
        </div>
    </form>
    <!-- end edit -->

    <!-- status -->
    <div class="d-flex justify-content-center mx-4">
        <div class="stats mt-4 mt-lg-0">
            <h1>Status</h1>
            <div class=" d-flex flex-column">
                <div class=" mx-3 d-flex justify-content-between mt-5 align-items-center">
                    <h3 class=" title fs-5 ">Totle Score </h3>
                    <div class=" num"> {{ $totle_score }}</div>
                </div>
                <div class="mx-3 d-flex justify-content-between mt-5 align-items-center">
                    <h3 class=" title fs-5 ">Reading Story </h3>
                    <div class=" num">{{ $stories }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- status -->
    <form class="mt-5 d-flex justify-content-center" action="/logout" method="post">
        @csrf
        <button class="text-black btn log-out " type="submit">Logout</button>
    </form>

    <script>
        document.title = "Profile";

        function edit() {
            let edit = document.querySelector(".edit-info")
            if (edit.style.display == "block") {
                edit.style.display = "none"

            } else {
                edit.style.display = "block"

            }
        }
    </script>
</x-layout>