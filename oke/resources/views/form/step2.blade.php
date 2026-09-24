<h2>Step 2</h2>

<p>Data 1: {{ $data1 }}</p>
<p>Data 2: {{ $data2 }}</p>

<form method="GET" action="/form/step3">
    <input type="hidden" name="data1" value="{{ $data1 }}">
    <button type="submit">Next</button>
</form>
