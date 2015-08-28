<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        
        <div id="twitter">
           <a class="twitter-timeline" href="https://twitter.com/hashtag/%D8%B7%D9%84%D8%B9%D8%AA_%D8%B1%D9%8A%D8%AD%D8%AA%D9%83%D9%85" data-widget-id="637271596466577409">#طلعت_ريحتكم Tweets</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
        </div>


        <div id="instafeed" style="float:right;width:450px">
            <script type="text/javascript" src="{{Asset('js/instafeed.min.js')}}"></script>
            <script type="text/javascript">
                var feed = new Instafeed({
                    get: 'tagged',
                    tagName: 'طلعت_ريحتكم',
                    clientId: '{{env('INSTAGRAM_APP_ID')}}'
                });
                feed.run();
            </script>

        </div>

    </body>
</html>
