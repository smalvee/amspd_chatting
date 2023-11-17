<!DOCTYPE html>
<html lang="en">

<head>

    <title>Test</title>

</head>

<body>

    <p>
        <b>Trade:- </b><span id="trade-data"></span>
    </p>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        Echo.channel('trades').listen('TestEvent', (e) => {
            console.log(e);
        });
    </script>






</body>

</html>