
@if($image)
    @php $rand = md5(rand(000, 999)); @endphp
    <!-- Button trigger modal -->
    <button data-bs-toggle="modal" data-bs-target="#showImage{{$rand}}" style="padding: 0; border: 0;">
        <img src="{{ $image }}" width="25px" height="25px"></img>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="showImage{{$rand}}" tabindex="-1" aria-labelledby="showImage{{$rand}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="showImage{{$rand}}Label">Preview</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <img src="{{ $image }}" width="100px" height="100px"></img>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endif