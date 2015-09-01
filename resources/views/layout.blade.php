<!doctype html>
<html lang="en">
@include('partials.head')

<body>


@include('partials.analytics')

@include('partials.jsInit')

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

@include('partials.newPostsAvailable')


</body>
</html>
