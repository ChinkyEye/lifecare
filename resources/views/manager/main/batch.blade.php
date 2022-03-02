<select class="form-control" name="batch_id" id="batch_data">
  {{-- <option value="">Select Batch</option> --}}
  @foreach ($batch as $key => $batch)
  <option value="{{ $batch->id }}" @if(Auth::user()->batch_id == $batch->id ) selected='selected'@endif >
    {{$batch->name}}
  </option>
  @endforeach
</select>