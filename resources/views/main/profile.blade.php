<x-layout>


    <form action="profile/{{$user->id}}" method="post" class="d-flex justify-content-center align-items-center flex-column flex-lg-row my-5 mx-0 mx-lg-5">
        @csrf
        @method('PATCH')
        <div class="edit-info p5 mx-5">
            <h1>Edit info</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input class="form-control" type="text" value="{{ $user->name }}" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" value="{{ $user->email }}" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">phone number</label>
                <input class="form-control" type="text" value="{{ $user->phone_number }}" name="phone">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input class="form-control" type="text" name='pass'>
            </div>
        </div>
        <div class="status mt-4 mt-lg-0">
            <h1>status</h1>
            <div>
                <h3 class="mb-4">Your totle Score : {{ $sum }}</h3>
                <h3>reading Story: {{ $re }}</h3>
            </div>
            <button type="submit" class="fs-4 mt-4">Save</button>
        </div>
    </form>
</x-layout>