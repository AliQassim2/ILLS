<x-layout>


    <form action="" class="d-flex justify-content-center align-items-center flex-column flex-lg-row my-5 mx-0 mx-lg-5">
        <div class="edit-info p5 mx-5">
            <img src="imges/354637.png" alt="user logo" class="logo-img ">
            <input type="file">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input class="form-control" type="text" value="{{ Auth::user()->name }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" value="{{ Auth::user()->email }}" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input class="form-control" type="text">
            </div>
        </div>
        <div class="status mt-4 mt-lg-0">
            <h1>status</h1>
            <div>
                <h3 class="mb-4">Track level : 1</h3>
                <h3>Day streak : 1</h3>
            </div>
            <button type="submit" class="fs-4 mt-4">Save</button>
        </div>
    </form>
</x-layout>