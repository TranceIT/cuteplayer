<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://vk.com/js/api/openapi.js?139" type="text/javascript"></script>
    </head>
    <body>
    

    <script type="text/javascript">
        VK.init({
            apiId: 5536088,
        });

        VK.Api.call('groups.getById', {group_id: 'cube_music'}, function(response) {
            console.log(response);
        });

        VK.Api.call('wall.get', {owner_id: -26914825, count: 5}, function(response) {
            console.log(response);
        });        

    </script>
    </body>
</html>
