<x-app>
@include ('publish-tweet-panel')

    @include('timeline')
    @push('scripts')
        <script>
            function loading(){
                $(".tweet-textarea").on('keydown', function(e) {
                    var words = this.value.length;
                    if (words <= 255) {
                        // $('#display_count').text(words);
                        $('#word_left').text(255-words)
                    }else{
                        if (e.which !== 8) e.preventDefault();
                    }
                });
            }
                window.onload = loading;
        </script>
    @endpush

</x-app>
