<!doctype html>
<html lang="en">
@include('partials.head')

<body>

{{-- Google Analytics --}}

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51741699-2', 'auto');
  ga('send', 'pageview');

</script>

<div id="layout" class="pure-g">
    @include('partials.sidebar')

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the posts -->

            @include('partials.posts')

            @include('partials.footer')
        </div>
    </div>

</div>






</body>
</html>
