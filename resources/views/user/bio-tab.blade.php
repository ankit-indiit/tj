<div class="flex justify-between relative md:mb-4 mb-3 mt-5 border-b pb-3">
    <div class="flex-1">
        <h2 class="text-xl font-semibold">Bio</h2>
    </div>

    <div></div>
</div>

<div class="row mt-4">
    <div class="col-8">
        <form method="POST" action="{{ url('update-user-bio') }}" id="updateBioForm">
            @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="profile-inp">
                    <textarea name="bio_text" id="bio_text" class="form-control" rows="3" placeholder="Add Bio">
                        {{ Auth::user()->bio }}
                    </textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <button type="submit" id="upd_bio_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                    Update
                </button>
                <a href="{{ url('my-profile') }}?tab=feed"
                    class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                    Cancel
                </a>
            </div>
        </div>
        </form>
    </div>
</div>