<select {{ $attributes->merge(['class' => 'form-select']) }}>
    <option value="">Select Country</option>
    @foreach ( $countries as $code => $country )
        <option value="{{ $code }}">{{ __( $country ) }}</option>
    @endforeach
</select>
