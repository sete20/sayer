@include('landing-r.includes.fotter')

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js" integrity="sha512-s/q7apy90iY/BCy3HnkSxOxqO30Sto5LnhQorz/ce4O/oBxDi1dKluM6C/SYy1AJ9+6MJfXnQl4mHVmrSYfujQ==" crossorigin="anonymous"></script>
<script>
      var input = document.querySelector("#phone");
      window.intlTelInput(input, {
            hiddenInput: "full_number"
            , initialCountry: "ae"
            , separateDialCode: true
            , utilsScript: "{{asset('js/utils.js')}}"
      , });

</script>
