<select {{ $attributes->merge(['class' => 'form-select']) }}>
  <option value="">Select Project</option>
    @foreach ( $projects as $project )
      @if ( $project->id == $selected )
        <option value="{{ $project->id }}" selected>{{ $project->name }}</option>
      @else
        <option value="{{ $project->id }}">{{ $project->name }}</option>
      @endif
   @endforeach
</select>
