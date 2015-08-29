<?php 
    $latestPosts = \Cache::get('lastThirtyPosts');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        
    </head> 
    <body>

        <table>
            <tbody>

            @foreach($latestPosts as $post)                
                <tr>
                    <td><img src="{{$post->user_profile_pic}}">{{$post->user_name}} on {{$post->provider}}</td>
                    <td>{{$post->date_published}}</td>
                    <td>{!!$post->html_content!!}</td>
                    <td></td>
                </tr>
            @endforeach
    
            </tbody>
        </table>

    </body>
</html>
