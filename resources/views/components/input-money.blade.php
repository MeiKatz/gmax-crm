@pushOnce('scripts')
<script>
jQuery(function () {
  let lastValue;

  const $body = jQuery('body');

  $body.on('keydown', '.input-money', function (evt) {
    lastValue = evt.target.value;
  });

  $body.on('input', '.input-money', function (evt) {
    const pattern = new RegExp('^' + evt.target.pattern + '$');

    if ( !pattern.test( evt.target.value ) ) {
      evt.target.value = lastValue;
      evt.preventDefault();
      evt.stopPropagation();
    }
  });
});
</script>
@endPushOnce

<div {{ $attributes->only('class')->merge(['class' => 'input-group input-money']) }}>
  <span class="input-group-text" title="currency">
    {{ $currencyCode }}
  </span>
  <input type="text" pattern="{{ $pattern }}" autocomplete="off" value="{{ $amount }}" class="form-control" {{ $attributes->except('class') }} />
</div>
