@extends("layouts.admin-template")

@section("content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #reader {
        width: 600px;
    }
    #result {
        text-align: center;
        font-size: 1rem;
    }
</style>
<main>
    <div id="reader"></div>
    <div id="result"></div>
</main>
<form action="" method="post" hidden="">
    @csrf
    <input name="qr_data" id="qr_data"/>
    <button id="send" type="submit">send</button>
</form>

<script>
    const scanner = new Html5QrcodeScanner('reader', {
        qrbox: {
            width: 250,
            height: 250,
        },
        fps: 20,
    });
    scanner.render(success, error)

    function success(result) {

        document.getElementById("qr_data").value = result
        document.getElementById("send").click()
        scanner.clear();
        document.getElementById('reader').remove();
    }
    function error(err) {
        console.error(err);
    }
</script>
@endsection()

