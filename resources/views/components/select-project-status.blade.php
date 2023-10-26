<select {{ $attributes->merge(['class' => 'form-select']) }}>
    <option value="1" @if ( $status == 1) selected @endif>Not Started</option>
    <option value="2" @if ( $status == 2) selected @endif>In Progress</option>
    <option value="3" @if ( $status == 3) selected @endif>In Review</option>
    <option value="4" @if ( $status == 4) selected @endif>On Hold</option>
    <option value="5" @if ( $status == 5) selected @endif>Completed</option>
    <option value="6" @if ( $status == 6) selected @endif>Cancelled</option>
</select>
