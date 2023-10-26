<select {{ $attributes->merge(['class' => 'form-select']) }}>
    <option value="">Select Client</option>
    @foreach ( $clients as $client )
    <option value="{{ $client->id }}">{{ $client->name }}</option>
    @endforeach
</select>
