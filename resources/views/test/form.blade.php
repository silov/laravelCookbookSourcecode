<h3>This is A Form</h3>
<hr>

<form method="post" action="/test/what">
    <input type="text" name="name" /><br>
    {{csrf_field()}}
    <input type="submit">
</form>